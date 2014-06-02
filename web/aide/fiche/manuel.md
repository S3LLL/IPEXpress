## Télécharger et graver l'image sur une clé USB

Sur cette page vous trouverez les instruction pour créer votre propre clé USB bootable avec l'application.

Une clé USB bootable signifie que l'ordinateur peu démarer avec les fichiers qui sont stocké dessus.

Avant de commencez, pensez brancher votre clé USB sur votre ordinateur.

#### 1. télécharger l'application

Télechargez le fichier: [ipex.usb](http://google.com).

Sauvgardez dans un dossier ou vous y aurait facilement acces, par exemple sur le bureau.

#### 2. télécharger et lancez UNetbootin

UNetbootin est une application libre qui permet de graver des fichiers sur des clés USB. Pour plus d'information, voir le [site officiel](http://unetbootin.sourceforge.net/).

Téléchargez et installez le logiciel en cliquant sur le nom de votre systéme:

- [UNetbootin pour Windows](http://unetbootin.sourceforge.net/unetbootin-windows-latest.exe)
- [UNetbootin pour Mac](http://unetbootin.sourceforge.net/unetbootin-mac-latest.zip)
- [UNetbootin pour Linux](http://unetbootin.sourceforge.net/unetbootin-linux-latest)

Maintenant lancez UNetbootin. Vous devriez arriver sur la fenettre suivant:

![capture1](https://raw.githubusercontent.com/S3LLL/IPEXpress/master/dev/wikimg/capture1.png)

#### 3. configurer UNetbootin

![capture2sou](https://raw.githubusercontent.com/S3LLL/IPEXpress/master/dev/wikimg/capture2sou.png)

Faite attention à bien configurer votre fenettre comme sur la capture d'ecran. Les option souligné en rouge son simple et prennent toujours les même valeur. Mais les deux options souligné en vert demande un peu plus de travail.

Tout d'abbord, cliquez sur les point de suspention à coté du premier tait vert et choicez le chemin du fichier `ipex.usb` prédement téléchargé sur le bureau.

Pour les deuxiéme trait vert, vous avez au moins deux aption (sinon verfiez que votre clé est bien inseré). Les utilisateur de Windows doivent choisir la lettre correspondant à la clé USB puis aller à l'étape 4. Les autres veyez lire le paragraph suivant.

Dans les options disponible, il faut trouver la quelle correspond à votre clé. pour cela, ouvrez un terminal et entrez la commande `df -h` et vous devez avoir un résulat ressemblant à celui ci:

```
Filesystem      Size   Used  Avail Capacity  iused    ifree %iused  Mounted on
/dev/disk0s2   246Gi  161Gi   85Gi    66% 42217580 22235542   66%   /
devfs          190Ki  190Ki    0Bi   100%      660        0  100%   /dev
map -hosts       0Bi    0Bi    0Bi   100%        0        0  100%   /net
map auto_home    0Bi    0Bi    0Bi   100%        0        0  100%   /home
/dev/disk0s4    51Gi   48Gi  3.6Gi    94%   188199  3763897    5%   /Volumes/Windows HD
/dev/disk2s2   7.0Gi  149Mi  6.8Gi     3%        0        0  100%   /Volumes/RICAIN-USB
```

Il s'agit d'un tableau avec tout les disque de votre ordinateur. On remarque la dernière ligne, dernière colonne: `RICAIN-USB` est le nom de la clé usb pour l'exemple. On regarde donc au début de la derniére ligne et on remarque `/dev/disk2s2`. Ainsi il faut choisir cette option pour `Drive`. Ceci était un exemple, vous devez faire cette procedure pour votre clé USB.

#### 4. graver la clé USB

Une fois que l'étape 3 est terminer vous pouvez appuyer sur OK puis tout se fait tout seul:

![capture3](https://raw.githubusercontent.com/S3LLL/IPEXpress/master/dev/wikimg/capture3.png)

Une fois terminer vous pouvez brancher la clé sur n'importe quelle **PC** et utiliser l'application à vos souhait.
