<h2>
    Prggmr::load <span>since v.0.0.1</span>
</h2>
<p>
    Locates a file on the file system using either a class name or a "." delimited string using
    the libraries added via <a href="<?=plink('/prggmr/library')?>">prggmr::library</a>.
</p>
<div class="method">
    prggmr::library($class <em>[, array $options = array()]</em>)
    <p>
        Attempts to locate a file located on the file system using the libraries defined via prggmr::library.
    </p>
    <ul>
        <li>
            <div class="element">$class <span>string</span></div>
            A class name to autoload, or a "." delimited string containing the path to a file.
        </li>
        <li>
            <div class="element">$options <span>array</span></div>
            An array of options to use for when loading a file.
            <ul>
                <li>
                    <div class="element">return_path <span>boolean</span></div>
                    <span class="default">default: false</span>
                    The path generated by load will be returned rather than loading the file, useful for finding the paths for class files.
                </li>
                <li>
                    <div class="element">require <span>boolean</span></div>
                    <span class="default">default: false</span>
                    Acts just like php's require function only throwing a RuntimeException if the file cannot be located.
                </li>
            </ul>
        </li>
    </ul>
</div>
<h2>
    Exceptions
</h2>
<ul>
    <li>
        <h3>
            RuntimeException
        </h3>
        <p>
            Thrown when the 'require' option is true and the file cannot be found on the system.
        </p>
    </li>
</ul>
<h2>
    Returns
</h2>
<ul>
    <li>
        <h3>
            Boolean
        </h3>
        <p>
            <strong>True</strong> on success and 'return_path' is false, <strong>False</strong> if failure and 'require' option is false.
        </p>
    </li>
    <li>
        <h3>
            String
        </h3>
        <p>
            When the 'return_path' option is set to true and success.
        </p>
    </li>
</ul>
<h2>
    Examples
</h2>
<p>
    <strong>Example #1 :</strong> Register the load function as an autoloader.
</p>
<pre class="prettyprint linenums">
spl_autoload_register('\prggmr::load', false);
</pre>
<p>
    <strong>Example #2 :</strong> Directly attempt to load a file using delimited string.
</p>
<pre class="prettyprint linenums">
\prggmr::load('my.custom.app.class');
</pre>
<p>
    <strong>Example #3 :</strong> Require a class file
</p>
<pre class="prettyprint linenums">
try {
    \prggmr::load('my\custom\app\Class', array(
        'require' => true
    ));
} catch (RuntimeException $e) {
    echo 'Failed to locate the my.custom.app.class file!';
}
</pre>
<p>
    <strong>Example #4 :</strong> Return the path to a class file
</p>
<pre class="prettyprint linenums">
echo \prggmr::load('my\custom\app\Class', array(
    'return_path' => true
));
</pre>
<p>
    Results
</p>
<pre class="prettyprint linenums">
/var/www/apps/yourapp/my/custom/app/Class.php
</pre>
<h2>
    Notes
</h2>
<ul class="class-overview">
    <li>
        If using load as a autoload function in a autoloading stack ( as the example above ), the load method has it's own internal stack of libraries that may be different
        than those used by PHP.
    </li>
</ul>