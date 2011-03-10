<h2>
    Prggmr::library <span>since v.0.0.1</span>
</h2>
<p>
    Adds a library that will be used when loading files via <a href="<?=plink('/prggmr/load')?>">prggmr::load</a>.
</p>
<div class="method">
    prggmr::library($name <em>[, array $options = array()]</em>)
    <p>
        Adds a new library that will be used when loading files via prggmr::load.
    </p>
    <ul>
        <li>
            <div class="element">$event <span>string</span></div>
            Name used to identify this library. e.g. Zend Framework, PEAR Autoloading etc..
        </li>
        <li>
            <div class="element">$options <span>array</span></div>
            An array of options to use for this library. These options define how files will be located with this library.
            <ul>
                <li>
                    <div class="element">path <span>string</span></div>
                    <span class="default">default: PRGGMR_LIBRARY_PATH</span>
                    Path to use when locating files using this library.
                </li>
                <li>
                    <div class="element">prefix <span>string</span></div>
                    <span class="default">default: null</span>
                    A string to prepend to all filenames before load attempts to locate them on the filesystem. e.g. `library/myclasses` -> `library/myclasses/mylib/orm/sqlite`
                </li>
                <li>
                    <div class="element">ext <span>string</span></div>
                    <span class="default">default: .php</span>
                    String extension appended to file paths
                </li>
                <li>
                    <div class="element">transformer <span>Closure</span></div>
                    <span class="default">default: PEAR Naming Conventions</span>
                    A Closure that accepts the $class, $namespace and $options parameters and is expected to return a modified file location string.
                </li>
                <li>
                    <div class="element">shift <span>boolean</span></div>
                    <span class="default">default: false</span>
                    Shifts this library loader to the beginning of the stack, useful for ensuring it is used for autoloading.
                </li>
                <li>
                    <div class="element">merge <span>boolean</span></div>
                    <span class="default">default: false</span>
                    Allows runtime modification of pre-existing libraries, such as adding new paths check for files.
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
            InvalidArgumentException
        </h3>
        <p>
            Thrown when an invalid path is provided.
        </p>
    </li>
</ul>
<h2>
    Examples
</h2>
<p>
    <strong>Example #1 :</strong> Add a library to load files using the PEAR naming conventions located at the vendors/apps/ directory, this requires only to add the name of the library
    as Prggmr is setup to handle this by default.
</p>
<pre class="prettyprint linenums">
\prggmr::library('PEAR Loader', array(
    'path' => 'vendors/apps/'
));
</pre>
<p>
    <strong>Example #2 :</strong> A custom load which will load classes using the namespace/class.inc.php naming schema, added as our first library.
</p>
<pre class="prettyprint linenums">
\prggmr::library('my custom loader', array(
    'path' => '/var/www/myapp/lib/',
    'ext'  => '.inc.php',
    'transformer' => function ($class, $namespace, $options) {
        $namespace = strtolower(str_replace('\\', DIRECTORY_SEPARATOR, $namespace));
        return $namespace.strtolower($class);
    },
    'shift' => true // Prepend to the beginning of the library stack
));
</pre>
<p>
    <strong>Example #3 :</strong> Add a new path to load files for an already existing library
</p>
<pre class="prettyprint linenums">
\prggmr::library('my existing library', array(
    'path' => '/var/www/myapp/lib/',
    'merge' => true // Set to true to tell prggmr we want to merge these settings
));
</pre>