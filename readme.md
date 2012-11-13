Usefull scripts
===============

Ytdl
----
Shortcut for ```youtube-dl``` command.


run-editor.sh
-------------
Gedit runner for ```editor://``` protocol. For more details see http://pla.nette.org/cs/jak-otevrit-soubor-z-debuggeru-v-editoru#toc-linux.


convert2mp3
-----------
Media files converter to MP3 format (extract audio track to MP3 file). Require ```ffmpeg``` command && ```nette.min.php``` library.

Usage:
```
> convert2mp3 <first ext> <second ext> <...>
```

For example:

```
> convert2mp3 flv mp4 avi
```


dataurigen
----------
Script for generation of DataURI string to TXT file from data file (for example from JPG, PNG or GIF file).

Usage:
```
> dataurigen <input-file-path> <output-file-path>
```

For example:
```
> dataurigen image.png image.txt
```

