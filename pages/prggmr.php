<h2>
    Prggmr <span>since v.0.0.1</span>
</h2>
<p>
    The prggmr class acts as a few major components of the framework, which may go aganist each object serving a single distanct purpose, the reason for
    this is to minimize the application code within the framework.
</p>
<p>
   The main responsiblity for this class is to act as the event engine, class loader, system debugger and analyzer.
</p>
<h2>
    Class synopsis
</h2>
<ul class="class-overview">
    <li>
        <a href="<?=plink('/prggmr/initialize')?>" rel="guide">
           initialize
        </a>

        - Sets up the framework environment
    </li>
    <li>
        <a href="<?=plink('/prggmr/version')?>" rel="guide">
           version
        </a>
        - Returns the current Prggmr version
    </li>
    <li>
        <a href="<?=plink('/prggmr/library')?>" rel="guide">
           library
        </a>
         - Adds a new library for autoloading classes
    </li>
    <li>
        <a href="<?=plink('/prggmr/load')?>" rel="guide">
           load
        </a>
        - Class autoloader
    </li>
    <li>
        <a href="<?=plink('/prggmr/listen')?>" rel="guide">
           listen
        </a>
        - Global event subscriber
    </li>
    <li>
        <a href="<?=plink('/prggmr/haslistener')?>" rel="guide">
           hasListener
        </a>
        - Returns if there are any subscribers to an event
    </li>
    <li>
        <a href="<?=plink('/prggmr_trigger')?>" rel="guide">
            trigger
        </a>
        - Global event publisher, bubbles event triggering all subscribers
    </li>
    <li>
        <a href="<?=plink('/prggmr/debug')?>" rel="guide">
            debug
        </a>
        - Debugging utility
    </li>
    <li>
        <a href="<?=plink('/prggmr/registry')?>" rel="guide">
            registry
        </a>
        - Data registry
    </li>
    <li>
        <a href="<?=plink('/prggmr/analyze')?>" rel="guide">
            analyze
        </a>
        - Provides system benchmarking tools
    </li>
    <li>
        <a href="<?=plink('/prggmr/__callStatic')?>" rel="guide">
            __callStatic
        </a>
        - Statically overloads method calls to publish events.
    </li>
</ul>