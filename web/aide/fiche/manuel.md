## Télécharger et graver l'image sur une clé USB

Sur cette page vous trouverez les instructions pour créer votre propre clé USB bootable avec l'application.

Une clé USB bootable signifie que l'ordinateur peu démarrer avec les fichiers qui sont stockés dessus.

Avant de commencer, pensez brancher votre clé USB sur votre ordinateur.

#### 1. télécharger l'application

Télèchargez le fichier: [ipex.usb](https://185.13.37.145/jean/ipex/ipex.usb).

Sauvegardez dans un dossier ou vous y aurez facilement accès, par exemple sur le bureau.

#### 2. télécharger et lancer UNetbootin

UNetbootin est une application libre qui permet de graver des fichiers sur des clés USB. Pour plus d'informations, voir le [site officiel](http://unetbootin.sourceforge.net/).

Téléchargez et installez le logiciel en cliquant sur le nom de votre système:

- [UNetbootin pour Windows](http://unetbootin.sourceforge.net/unetbootin-windows-latest.exe)
- [UNetbootin pour Mac](http://unetbootin.sourceforge.net/unetbootin-mac-latest.zip)
- [UNetbootin pour Linux](http://unetbootin.sourceforge.net/unetbootin-linux-latest)

Maintenant, lancez UNetbootin. Vous devriez arriver sur la fenêtre suivante:

![capture1](https://raw.githubusercontent.com/S3LLL/IPEXpress/master/dev/wikimg/capture1.png)

#### 3. configurer UNetbootin

![capture2sou](https://raw.githubusercontent.com/S3LLL/IPEXpress/master/dev/wikimg/capture2sou.png)

Faites attention à bien configurer votre fenêtre comme sur la capture d'écran. Les options soulignées en rouge sont simples et prennent toujours les mêmes valeurs. Mais les deux options soulignées en vert demandent un peu plus de travail.

Tout d'abord, cliquez sur les points de suspension à coté du premier tait vert et choisissez le chemin du fichier `ipex.usb` précédemment téléchargé sur le bureau.

Pour le deuxième trait en vert, vous devez avoir au moins deux options (sinon vérifiez que votre clé est bien insérée). Les utilisateurs de Windows doivent choisir la lettre correspondant à la clé USB puis aller à l'étape 4. Les autres veillez lire le paragraphe suivant :

Dans les options disponibles, il faut trouver celle qui  correspond à votre clé. pour cela, ouvrez un terminal et entrez la commande `df -h` et vous devez avoir un résultat ressemblant à celui ci:

    Filesystem      Size   Used  Avail Capacity  iused    ifree %iused  Mounted on
    /dev/disk0s2   246Gi  161Gi   85Gi    66% 42217580 22235542   66%   /
    devfs          190Ki  190Ki    0Bi   100%      660        0  100%   /dev
    map -hosts       0Bi    0Bi    0Bi   100%        0        0  100%   /net
    map auto_home    0Bi    0Bi    0Bi   100%        0        0  100%   /home
    /dev/disk0s4    51Gi   48Gi  3.6Gi    94%   188199  3763897    5%   /Volumes/Windows HD
    /dev/disk2s2   7.0Gi  149Mi  6.8Gi     3%        0        0  100%   /Volumes/RICAIN-USB

Il s'agit d'un tableau avec tout les disques  de votre ordinateur. On remarque la dernière ligne, dernière colonne: `RICAIN-USB` est le nom de la clé usb pour l'exemple. On regarde donc au début de la dernière ligne et on remarque `/dev/disk2s2`. Ainsi il faut choisir cette option pour `Drive`. Ceci était un exemple, vous devez faire cette procédure pour votre clé USB.

#### 4. graver la clé USB

Une fois que l'étape 3 est terminée vous pouvez appuyer sur OK puis tout se fait tout seul:

![capture3](https://raw.githubusercontent.com/S3LLL/IPEXpress/master/dev/wikimg/capture3.png)

Une fois  l'opération terminée, vous pouvez brancher la clé sur n'importe quel **PC** et utiliser l'application à vos souhaits.
