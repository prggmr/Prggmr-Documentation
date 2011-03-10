<h2>
    Prggmr::version <span>since v.0.0.1</span>
</h2>
<p>
    Returns the current version of the Prggmr Framework.
</p>
<div class="method">
    prggmr::version(<em>null</em>)
    <p>
        Returns the current prggmr version.
    </p>
</div>
<h2>
    Examples
</h2>
<p>
    <strong>Example #1 :</strong> Printout the current version of Prggmr
</p>
<pre class="prettyprint linenums">
echo \prggmr::version();
</pre>
<p>
    <strong>Results</strong>
</p>
<pre class="prettyprint">
0.0.1
</pre>
<p>
    <strong>Example #2 :</strong>
</p>
<pre class="prettyprint linenums">
if (version_compare(\prggmr::version(), '0.0.2b', '=')) {
    echo 'I am version 0.0.2b!';
}

if (version_compare(\prggmr::version(), '0.0.2b', '>')) {
    echo 'Im running less than 2 which is current ' . PRGGMR_VERSION;
}

if (version_compare(\prggmr::version(), '0.0.3', '=')) {
    echo 'I havent been released yet as I am ' . PRGGMR_VERSION;
}
</pre>
<h2>
    Notes
</h2>
<ul class="class-overview">
    <li>
        The constant <strong>PRGGMR_VERSION</strong> also holds the current Prggmr Version.
    </li>
    <li>
        All Prggmr version are "PHP-standardized"
    </li>
</ul>