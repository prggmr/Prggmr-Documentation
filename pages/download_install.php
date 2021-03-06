<!--
[PRGGMR
@title What is Prggmr?
@link prggmr-intro
@category About
]
-->
<h2>
    Prggmr Download &amp; Installation
</h2>
<p>
    You may download Prggmr using any of the below links.
</p>
<ul>
    <li>
        <h3>
            Latest Stable Release
        </h3>
        <p>
            The latest stable production ready version of Prggmr, this version is recommended if you plan on
            developing applications which will be used in a live environment.
        </p>
        <p>
            <strong>Select Format :</strong> <a href="https://github.com/nwhitingx/Prggmr/zipball/master">Zip</a> | <a href="https://github.com/nwhitingx/Prggmr/tarball/master">Tarball</a>
        </p>
    </li>
    <li>
        <h3>
            Nightly Development Build
        </h3>
        <p>
           The blazing nightly build is available to those daring enough to use it.
        </p>
        <p>
            <strong>Select Format :</strong> <a href="https://github.com/nwhitingx/Prggmr/zipball/dev">Zip</a> | <a href="https://github.com/nwhitingx/Prggmr/tarball/dev">Tarball</a>
        </p>
    </li>
    <li>
        <h3>
            Git Repository
        </h3>
        <p>
           Prggmr is also available via git you may visit <a href="http://github.com/nwhitingx/Prggmr" target="_blank">Github</a> to checkout
           a particular version of Prggmr or checkout the latest stable via the following.
        </p>
        <pre class="prettyprint">
git clone https://nwhitingx@github.com/nwhitingx/Prggmr.git
        </pre>
    </li>
</ul>
<h2>
    Installation
</h2>
<p>
    Prggmr can be installed in a variety different fashions depending on your needs,
    as such we will cover the most common flavors.
</p>
<ul>
    <li>
        <h3>
            Local installation per application
        </h3>
        <p>
            This method is the easiest route of installation which installs Prggmr to your current applications directory
            and require you to reinstall Prggmr with each additional project you wish to utilize Prggmr.
        </p>
        <ol>
            <li>
                Download and extract a copy of Prggmr.
            </li>
            <li>
                Copy all files into the directory you wish to store Prggmr within your application.
            </li>
            <li>
                <p>
                    Include the Prggmr library file and initialize the framework.
                </p>
                <pre class="prettyprint">
require 'PATH_TO_YOUR_INSTALLATION/prggmr.php';

\prggmr::initialize();
                </pre>
            </li>
        </ol>
    </li>
    <li>
        <h3>
            Global installation to PHP include directory
        </h3>
        <p>
            This method installs Prggmr to your PHP_INCLUDE_PATH which enables a single copy of Prggmr to be used system wide.
        <ol>
            <li>
                Download and extract a copy of Prggmr.
            </li>
            <li>
                <p>
                    Create the "Prggmr" directory in your PHP_INCLUDE_PATH.
                </p>
                <p>
                    <em>If you are unsure of your PHP_INCLUDE_PATH you may run the following code in a php file to retrieve it</em>
                </p>
                <pre class="prettyprint">
echo get_include_path();
                </pre>
            </li>
            <li>
                <p>
                    Extract the entire copy of Prggmr into the "Prggmr" directory, e.g..
                </p>
                <pre class="prettyprint">
/usr/local/lib/php/Prggmr
    |- lib
        |- util
        |- event.php
        |- listenable.php
        |- prggmr.php
    |- README
    |- etc..etc..
                </pre>
            </li>
            <li>
                <p>
                    Test your installation.
                </p>
                <pre class="prettyprint">
require 'Prggmr/lib/prggmr.php';

\prggmr::initialize();
                </pre>
            </li>
        </ol>
    </li>
    <li>
        <h3>
            Linux system wide git clone
        </h3>
        <p>
            This method uses the CLI and is the preferred method of installation as it enables a single copy of Prggmr to be used system wide,
            and uses git yay!. <strong>NOTE:</strong> this method will require sudo access.
        <ol>
            <li>
                <p>
                    Locate your php include path.
                </p>
                <pre class="prettyprint">
php -i | grep include_path
                </pre>
                <p>
                    <strong>Example output :</strong> include_path => .:/usr/local/lib/php => .:/usr/local/lib/php
                </p>
            </li>
            <li>
                <p>
                    cd into the include path
                </p>
                <pre class="prettyprint">
cd /usr/local/lib/php
                </pre>
            </li>
            <li>
                <p>
                    Clone the latest stable release.
                </p>
                <pre class="prettyprint">
sudo git clone https://nwhitingx@github.com/nwhitingx/Prggmr.git
                </pre>
            </li>
            <li>
                <p>
                    Test your installation.
                </p>
                <pre class="prettyprint">
require 'Prggmr/lib/prggmr.php';

\prggmr::initialize();
                </pre>
            </li>
        </ol>
    </li>
</ul>
<h2>
    Requirements
</h2>
<ul>
    <li>
        <h3>
            PHP 5.3+
        </h3>
        <p>
            The Prggmr framework is designed to run on PHP installations using <em>PHP 5.3+</em>, Prggmr has
            no other library requirements, and is platform independent.
        </p>
    </li>
</ul>
