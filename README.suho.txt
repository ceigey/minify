INSTALLATION
     git clone --origin google https://code.google.com/r/pierredumuid-suho-minify/ /usr/local/minify/
     ln -s /usr/local/minify/apache2-mods-available/*  /etc/apache2/mods-available/
     a2enmod suho-minify

USE
     Ceate a file called "minify.ini" in a directory located "one-up" from the DocumentRoot (see the apache config
     file) of a website as follows:

======== SAMPLE minify.ini FILE ===========
[bar.js]
foo1 = "//path/after/document/root/to/foo1.js"
foo2 = "//another/path/after/document/root/to/foo2.js"
foo3 = "//yet/another/path/after/document/root/to/foo3.js"

[yee.css]
haa1 = "//path/after/document/root/to/haa1.css"
haa2 = "//another/path/after/document/root/to/haa2.css"
haa3 = "//yet/another/path/after/document/root/to/haa3.css"
===========================================

Then to accessed the "minified" merge of the files in each section of the ini file, use the following links
in your website:

       href="/minify/bar.js"
or
       href="/minify/bar.js?debug"

to enable debugging.
