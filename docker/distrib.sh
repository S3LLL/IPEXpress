mount -o loop /opt/IPEXpress/distrib/ubuntu/ubuntu-14.04.2-desktop-amd64.iso /mnt
cp /mnt/casper/initrd.lz /mnt/casper/vmlinuz.efi /opt/IPEXpress/distrib/ubuntu
touch /opt/IPEXpress/distrib/ubuntu/param.json

cat << EOF > /opt/IPEXpress/distrib/ubuntu/param.json
{
   "name"   : "ubuntu",
   "image"  : "ubuntu-14.04.2-desktop-amd64.iso",
   "kernel" : "vmlinuz.efi",
   "initrd" : "initrd.lz",
   "args"   : "boot=casper netboot=nfs"
}
EOF
umount /mnt
exit 0 
