<h2>
    Prggmr::initialize <span>since v.0.0.1</span>
</h2>
<p>
    Builds the Prggmr framework environment, setting up and validating any required variables, this method <strong>must</strong> be called

<div class="method">
    prggmr::initialize(<em>null</em>)
    <p>
        Startup the Prggmr framework, establishing all required local vars.
    </p>
</div>
<h2>
    Examples
</h2>
<p>
    Include the prggmr framework and initialize.
</p>
<pre class="prettyprint linenums">
set_include_path(getcwd() . DIRECTORY_SEPARATOR . get_include_path());
require 'lib/prggmr.php';
\prggmr::initialize();
</pre>