<!--
[PRGGMR
@title What is Prggmr?
@link prggmr-intro
@category About
]
-->
<h2>
    About Prggmr
</h2>
<p>
    Prggmr is an event framework written using the PHP language, it was developed by
    <a href="http://www.nwhiting.com" target="_blank">Nickolas Whiting</a>, aiming to
    provide developers with a tool for developing scalable, de-coupled event driven software. Prggmr
    is free software refer to the <a href="<?=plink('license')?>" rel="guide">Prggmr License</a> for more information.
</p>
<h2>
    Features
</h2>
<ul>
    <li>
        <h3>
            Simple Event Processing
        </h3>
        <p>
            Utilizing the feature enhancements in PHP 5.3, Prggmr introduces a simple event processing
            engine in PHP.
        </p>
    </li>
    <li>
        <h3>
            Lightweight, Portable & Ready Out of the Box
        </h3>
        <p>
            The code base of Prggmr weighs in just under <em>80k</em>, can be included into existing applications
            using only 2 lines of code, and requires no configuration.
            <pre class="prettyprint">
require 'lib/prggmr.php';

\prggmr::initialize();
            </pre>
        </p>
    </li>
    <li>
        <h3>
            Flexibility
        </h3>
        <p>
            The Prggmr API is extremely flexible in how it publishes and subscribes to events, allowing you
            to choose your suit of development.
        </p>
    </li>
    <li>
        <h3>
            Robust &amp; Scalable, Simple &amp; Intuitive
        </h3>
        <p>
            Prggmr has been developed to be a robust, scalable solution for seasoned veterans, while
            keeping itself simple and intuitive for the noobs.
        </p>
        <p>
            Take a look at the below example, demonstrating the publishing and subscription methods.
        </p>
        <pre class="prettyprint">
// Subscribe to an event
\prggmr::listen('event_name', function($event, $name){
    // Action to take
    echo $name;
});

// Publish an event
\prggmr::trigger('event_name', array('nick'));
        </pre>
        <p>
            <a href="#" onclick="loadExample('Prggmr Introduction', 'examples/prggmr_intro.php'); return false;">Run this example!</a>
        </p>
    </li>
    <li>
        <h3>
            Test Driven Development
        </h3>
        <p>
            The entire code base of Prggmr has been developed with great discipline with 100% of its code base tested
            to ensure its stability.
        </p>
    </li>
</ul>
<h2>
    Prggmr the Framework
</h2>
<p>
    The Prggmr framework is the fruit of 3 years of continuous development, researching, mistakes and enlightenment into
    software architectural patterns. Prggmr has been a long-term goal that is finally achieved and I hope
    that everyone enjoys the framework as much as I enjoyed developing it.
</p>