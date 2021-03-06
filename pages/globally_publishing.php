<!--
[PRGGMR
@title Hello Events Tutorial
@link hello-events-tutorial
@category Prggmr Library
]
-->
<h2>
Your First Prggmr Event!
</h2>
<!--<p>
    The following is a simple tutorial introduction to the Prggmr API, this will provide a introduction into
    subscribing, publishing and using events with Prggmr.
</p>
<p>
    Before we begin with a in-depth event driven app, let's take a look at the all to common Hello World written into Prggmr's API.
</p>-->
<p>
    Well ... let's write some code now shall we?
</p>
<p>
    If you have not yet downloaded and installed the Prggmr Framework it is recommended you do so now, you may follow this
    <a href="<?=plink('/download_install')?>" rel="guide">link</a> for links and instructions.
</p>
<h2>
    hello world
</h2>
<br />
<pre class="prettyprint linenums">
// Subscribe to the "hello world" event.
prggmr::listen('hello world', function(){
   echo 'hello world';
});

// Publish the "hello world" event.
prggmr::trigger('hello world');
</pre>
<p>
    <a href="#" onclick="loadExample('hello world', 'examples/hello_events.php'); return false;">Run this example!</a>
</p>
<p>
    Simple isnt it :) once you've satisified your hello world geekness you can move on to the <a href="<?=plink('/api_introduction')?>" rel="guide">API Introduction</a>.
</p>
<h2>
    Breaking down the code!
</h2>
<p>
    Now that you have witnessed some of Prggmr's API in action let's go over the above code examples.
</p>
<p>
    In the first example we made use of two of Prggmr's available publishing and subscribing methods, trigger and listen.
</p>
<div class="method">
    <a href="/api/prggmr.html" rel="guide">prggmr</a>::<a href="<?=plink('pages/api/prggmr/listen')?>" rel="guide">listen</a>(<em>$event, \Closure $function [, array $options = array()]</em>)
    <p>
        Statically called global subscriber, registers a new event to be bubbled when a notice is received from the event engine. You may read more about the prggmr::listen method on the following
        <a href="<?=plink('/api/prggmr/listen')?>" rel="guide">page</a>.
    </p>
    <ul>
        <li>
            <div class="element">$event <span>string</span></div>
            Name of the event you want to subscribe to.
        </li>
        <li>
            <div class="element">$function <span>object</span></div>
            Closure object that will be executed when this event is bubbled.
        </li>
        <li>
            <div class="element">$options <span>array</span></div>
            An array of options to use when adding this subscriber.
            <ul>
                <li>
                    <div class="element">shift <span>boolean</span></div>
                    <span class="default">default: false</span>
                    Shifts this event to the beginning of the event queue causing it to trigger before any
                    previously added subscribers.
                </li>
                <li>
                    <div class="element">namespace <span>string</span></div>
                    <span class="default">default: \prggmr::GLOBAL_DEFAULT</span>
                    Namespace to attach this subscriber.
                </li>
                <li>
                    <div class="element">name <span>string</span></div>
                    <span class="default">default: null</span>
                    Name to give this subscriber.
                    <div class="note">
                        It is recommended to leave this option blank unless you are sure
                        you will not create naming collisions.
                    </div>
                </li>
                <li>
                    <div class="element">force <span>boolean</span></div>
                    <span class="default">default: false</span>
                    Force the addition of this subscriber if a name collision exists.
                    <div class="note">
                        This option is ignored unless "name" is given.
                    </div>
                </li>
            </ul>
        </li>
    </ul>
</div>
<div class="method">
    prggmr::trigger(<em>$event [, array $params = array(), array $options = array()]</em>)
    <p>
        Globally available publisher, pushes events to the event engine bubbling any subscribers. You may read more about the prggmr::trigger method on the following
        <a href="<?=plink('/api/prggmr/trigger')?>" rel="guide">page</a>.
    </p>
    <ul>
        <li>
            <div class="element">$event <span>string | object</span></div>
            Name of the event to publish or an instance of \prggmr::<a href="/api/prggmr/event">Event</a> object.
        </li>
        <li>
            <div class="element">$params <span>array</span></div>
            Array of parameters to pass to subscribers.
        </li>
        <li>
            <div class="element">$options <span>array</span></div>
            An array of options to use when publishing this event.
            <ul>
                <li>
                    <div class="element">namespace <span>string</span></div>
                    <span class="default">default: \prggmr::GLOBAL_DEFAULT</span>
                    Namespace to bubble this event within.
                </li>
                <li>
                    <div class="element">benchmark <span>boolean</span></div>
                    <span class="default">default: false</span>
                    Benchmarks this event execution, tracking the memory, execution time and CPU usage.
                </li>
                <li>
                    <div class="element">flags <span>string</span></div>
                    <span class="default">default: null</span>
                    Flags to pass to the <em>preg_match</em> function called for matching
                    regex style events.
                </li>
                <li>
                    <div class="element">offset <span>integer</span></div>
                    <span class="default">default: null</span>
                    Specify the alternate place from which to start the regex search.
                </li>
                <li>
                    <div class="element">suppress <span>boolean</span></div>
                    <span class="default">default: false</span>
                    Suppress exceptions when an event is encountered in a STATE_ERROR.
                    <div class="note">
                        Error suppression is highly unrecommended during any case.
                    </div>
                </li>
            </ul>
        </li>
    </ul>
</div>
<p>

</p>