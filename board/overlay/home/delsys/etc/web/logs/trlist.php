<?php

$sqliteDebug = true;

try {
	// connect to your database
	$sqlite = new SQLite3('/var/www/multicharger/app.db');
}
catch (Exception $exception) {
	// sqlite3 throws an exception when it is unable to connect
	echo '<p>There was an error connecting to the database!</p>';
	if ($sqliteDebug) {
		echo $exception->getMessage();
	}
}

// create a query that should return a single record
$query = 'SELECT * FROM TRANS ORDER BY SEQNO DESC LIMIT 10';

// execute the query
// query returns FALSE on error, and a result object on success

$sqliteResult = $sqlite->query($query);

if (!$sqliteResult and $sqliteDebug) {
	// the query failed and debugging is enabled
	echo "<p>There was an error in query: $query</p>";
	echo $sqlite->lastErrorMsg();
}
if ($sqliteResult) {
	// the query was successful
	// get the result (if any)
	// fetchArray returns FALSE if there is no record
	echo "[\n";
	while($record = $sqliteResult->fetchArray()) 
	{
		// we have a record so now we can use it
		echo "{";
		echo '"seqno":'.$record['seqno'].',';
		echo '"connector":'.$record['connid'].',';
		echo '"trid":'.$record['trid'].',';
		echo '"start_time":"'.$record['sr_time'].'",';
		echo '"stop_time":"'.$record['st_time'].'",';
		echo '"kwh":'. ($record['meter_stop'] - $record['meter_start']).',';
		echo '"stop_reason":"'.$record['st_reason'].'"';
		echo "}\n";
	}
	echo "]\n";
	
	// when you are done with the result, finalize it
	$sqliteResult->finalize();
}
 
// clean up any objects
$sqlite->close();
?>
