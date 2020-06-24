#!/bin/sh

BOARD_DIR="$(dirname $0)"
OVERLAY_CFG="${BOARD_DIR}/overlay"
TARGET_CFG="${TARGET_DIR}"
OUTPUT_CFG="${BASE_DIR}"

SPLIT_DIRECTORY="${BINARIES_DIR}/fware"

echo "This is delta post build"
echo "copy some files and pest at target folder"
echo "board dir" "${OVERLAY_CFG}"
echo "build dir" "${TARGET_CFG}"
echo "output dir" "${OUTPUT_CFG}"

echo "copying file"

cp -r "${OVERLAY_CFG}"/. "${TARGET_CFG}"/
echo "copying sps2.bmp..."
cp "${BR2_EXTERNAL_Variant_C_PATH}"/board/sps2.bmp "${BINARIES_DIR}"/sps.bmp


initramfs_PATH="/home/linuxBuilder/Final_BuildRoot/Microchip/Main_Line/Minimal_Rootfs/output/images/zImage"

slink="${BINARIES_DIR}"/zuImage

emptyPartition="${BINARIES_DIR}"/extract.ext4

if [ ! -h $slink ]; then

    echo "link does not exist and hense making"
    ln -s $initramfs_PATH "${BINARIES_DIR}"/zuImage
    
else

    echo "link exist no need to remake"
    
fi


if [ ! -e $emptyPartition ]; then

dd if=/dev/zero of="${BINARIES_DIR}"/extract.ext4 bs=1M count=1024
mkfs.ext4 "${BINARIES_DIR}"/extract.ext4

else

    echo "emptyPartition exist no need to remake"
    
fi





