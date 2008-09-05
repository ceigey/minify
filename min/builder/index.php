<?php 

require dirname(__FILE__) . '/../config.php';

ob_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<head>
    <meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
    <title>Minify URI Builder</title>
    <style type="text/css">
body {margin:1em 60px;}
h1, h2, h3 {margin-left:-25px; position:relative;}
h1 {margin-top:0;}
#sources {margin:0; padding:0;}
#sources li {margin:0 0 0 40px}
#sources li input {margin-left:2px}
#add {margin:5px 0 1em 40px}
#update, #results {display:none}
#uriTable {border-collapse:collapse;}
#uriTable td, #uriTable th {padding-top:10px;}
#uriTable th {padding-right:10px;}
#groupConfig {font-family:monospace;}
b {color:#c00}
#cachePathNote {background: #ff9; display:inline-block; padding:.5em .6em;}
    </style>
</head>

<?php if (! isset($min_cachePath)): ?>
<p id=cachePathNote><strong>Note:</strong> Please set <code>$min_cachePath</code> 
in /min/config.php to improve performance.</p>
<?php endIf; ?>

<h1>Minify URI Builder</h1>

<p>Create a list of Javascript or CSS files (or 1 is fine) you'd like to combine
and click [Update].</p>

<ol id=sources><li></li></ol>
<div id=add><button>Add file +</button></div>

<p><button id=update>Update</button></p>

<div id=results>

<h2>Minify URI</h2>
<p>Place this URI in your HTML to serve the files above combined, minified, compressed and with cache headers.</p>
<table id=uriTable>
    <tr><th>URI</th><td><a id=uriA class=ext>/min</a> <small>(opens in new window)</small></td></tr>
    <tr><th>HTML</th><td><input id=uriHtml type=text size=80 readonly></td></tr>
</table>

<h2>How to serve these files as a group</h2>
<p>For the best performance you can serve these files as a pre-defined group with a URI like:
<code>/min/?g=keyName</code></p>
<p>To do this, add a line like this to /min/groupsConfig.php:</p>

<pre><code>return array(
    <span style="color:#666">... your existing groups here ...</span>
<input id=groupConfig size=80 type=text readonly>
);</code></pre>

<p><em>Make sure to replace <code>keyName</code> with a unique key for this group.</em></p>
</div>

<hr>
<p>Need help? Search or post to the <a class=ext href="http://groups.google.com/group/minify">Minify discussion list</a>.</p>
<p><small>This app is minified :) <a class=ext href="http://code.google.com/p/minify/source/browse/trunk/min/builder/index.php">view source</a></small></p>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>

<script type="text/javascript">
    // workaround required to test when /min isn't child of web root
    var src = location.pathname.replace(/\/[^\/]*$/, '/_index.js').substr(1);
    document.write('<\script type="text/javascript" src="../?f=' + src + '"><\/script>');
</script>

<!--[ This comment remains because the "[" makes it look like an IE conditional comment :) -->
<?php

$serveOpts = array(
    'content' => ob_get_contents()
    ,'id' => __FILE__
    ,'lastModifiedTime' => max(
        // regenerate cache if either of these change
        filemtime(__FILE__)
        ,filemtime(dirname(__FILE__) . '/../config.php')
    )
    ,'minifyAll' => true
);
ob_end_clean();

set_include_path(dirname(__FILE__) . '/../lib' . PATH_SEPARATOR . get_include_path());

require 'Minify.php';

if (0 === stripos(PHP_OS, 'win')) {
    Minify::setDocRoot(); // we may be on IIS
}
Minify::setCache(isset($min_cachePath) ? $min_cachePath : null);
Minify::$uploaderHoursBehind = $min_uploaderHoursBehind;

Minify::serve('Page', $serveOpts);