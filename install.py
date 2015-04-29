#!/usr/bin/env python

import os
import json
import signal
import string
import sys

erreurs = 0

def ctrlc(signal, frame):
	print("")
	exit(erreurs)

signal.signal(signal.SIGINT,ctrlc)

if sys.version_info >= (3,0):
	read = input
else:
	read = raw_input

#print("Bienvenue sur l'installeur de IPEXpress")

#print("   detection du chemin de l'installation")
path = os.path.realpath(__file__).split("/")
path.pop()
path.append("")
path = "/".join(path) 
print(":) chemin: " + path)

print("   detection d'apache2 (serveur web)")
apache = os.path.exists("/usr/sbin/apache2")
if apache:
	print(":) apache2 semble etre present")	
else:
	print(":( apache2 ne semple pas etre present")

print("   detection de nfs-kernel-server")
nfsd = os.path.exists("/etc/init.d/nfs-kernel-server")
if nfsd:
	print(":) nfs-kernel-server semble etre present")
else:
	print(":( nfs-kernel-server ne semble pas etre present")

if not nfsd or not apache:
	print("\n   WARN: il semblerait qu'il vous manque des element necessaire a l'installation.")
	print("   voulez vous continuer?\n")

#try:
	#read("   appuyer sur une touche pour continuer ou ctrl+c pour arreter")
#except Exception:
#	pass

# Creation du fichier de parametre
print("\nEcriture du fichier /etc/ipexpress/settings.json")
try:
	sample = json.load(open(path + "dev/settings.sample.json","r"))
	sample["path"] = path
	if nfsd:
		sample["nfs-server-name"] = "nfs-kernel-server"
	else:
		sample["nfs-server-name"] = read("   entrer le nom du serveur nfs: ")
	sample["nfs-server"] = "192.168.220.169"
	sample["web-server"] = "192.168.220.169"
	if not os.path.exists("/etc/ipexpress/"):
		os.makedirs("/etc/ipexpress/")
	json.dump(sample,open("/etc/ipexpress/settings.json","w"),indent=4)
	print(":) fait!")
except Exception as e:
	print(":( " + str(e))
	erreurs += 1

# Ajout du fichier de configuration apache
print("\nEcriture du fichier /etc/ipexpress/apache2.conf")
try:
	sample = open(path + "dev/apache2.sample.conf","r")
	config = sample.readlines()
	real   = open("/etc/ipexpress/apache2.conf","w")
	for line in config:
		if "##path##" in line:
			line = str.replace(line,"##path##",path)
		real.write(line)
	real.close()
	print(":) /etc/ipexpress/apache2.conf cree")
	if not os.path.exists("/etc/apache2/conf.d/"):
		erreurs += 1
		print(":( impossible de trouver le repertoire /etc/apache2/conf.d/")
	else:
		os.symlink("/etc/ipexpress/apache2.conf","/etc/apache2/conf.d/ipexpress.conf")
		print(":) lien /etc/apache2/conf.d/ipexpress.conf cree")
	print("")
	oups = os.system("service apache2 restart")
	if oups:
		erreurs += 1
except Exception as e:
	print(":( " + str(e))
	erreurs += 1

exit(erreurs)
