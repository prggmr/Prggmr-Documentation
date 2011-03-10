<h2>
    Prggmr Interactive Console ( iConsole ) - <span class="red">Advanced</span>
</h2>
<p>
    The following guide covers the Prggmr iConsole codebase, if you are unfamiliar with iConsole it is a fully functional unix like console written in pure PHP code with the
    Prggmr framework.
</p>
<h2>
    Download, Requirements, Installation &amp; Run
</h2>
<ul>
    <li>
        <h3>
            Downloadable Archives
        </h3>
        <p>
            <strong>Select Format :</strong> <a href="https://github.com/nwhitingx/Prggmr-iConsole/zipball/master">Zip</a> | <a href="https://github.com/nwhitingx/Prggmr-iConsole/tarball/master">Tarball</a>
        </p>
        <h3>
            Checkout a copy from the offical repository
        </h3>
        <br />
        <pre class="prettyprint">
git clone git://github.com/nwhitingx/Prggmr-iConsole.git
        </pre>
    </li>
    <li>
        <h3>
            Requirements
        </h3>
        <p>
            Linux/Mac OS<br />
            Prggmr Framework v.0.0.1b
        </p>
    </li>
    <li>
        <h3>
            Installation
        </h3>
        <p>
            Extract the archive to your desired location if downloaded, no actions are required if you performed a clone of the repo.
        </p>
    </li>
    <li>
        <h3>
            Running iConsole
        </h3>
        <p>
            Simply navigate to the installation path and execute the "console" file.
        </p>
        <pre class="prettyprint linenums">
cd /path/to/iconsole/extraction
chmod 755 console
./console
        </pre>
    </li>
</ul>
<h2>
    The Structure
</h2>
<p>
    Before we dive into the code lets go over the directory structure.
<pre class="prettyprint linenums">
|- interactive_console # the root of the app
    |- databases/ # path to our sqlite databases
    |- events/ # path to our event files which will be scanned and included on load
    |- lib/ # the prggmr library
    |- modules/ # the core modules which power iconsole
    |- console # the php file containing our app code and our single entry point
</pre>
<h2>
    The Modules
</h2>
<p>
    The modules directory contains the objects which will perform the tasks of running our console, which involves providing a means of interaction,
    a user authentication layer and a command interrupter.
<ul>
    <li>
        <h3>
            modules/console.php
        </h3>
        <p>
            Let's begin by building from the ground up, our first task is to create a simple event object that will act as an abstraction
            object providing a means of outputting and receiving data via the console and will be used to extend all other events in our app.
        </p>
<pre class="prettyprint linenums">
namespace iconsole;

/**
 * Iconsole Prggmr Interactive Console
 *
 * @author Nickolas Whiting
 * @date February 17th, 2011
 */

/**
 * The console event allows for a event based interactive
 * console using php code, the class provides methods
 * for printing console strings and receiving feedback
 * using events, the class does not provide the actual
 * data but an interface for subscribing to the common events
 */

class Console extends \prggmr\Event
{
    public $_linkbreak = "\n";

    /**
     * Dumps a string to the console.
     *
     * @event  console_output  $string|$color
     * @param  string  $string  String to output
     *
     * @return  void
     */
    public function output($string, $options = array())
    {
        $defaults = array('lb' => "\n", 'color' => null);
        $options += $defaults;
        $this->setResultsStackable(true);
        fwrite(STDOUT, implode(LINE_BREAK, $this->console_output(array(
            $string,
            $options['color']
        ), array('object' => true))->getResults()));
        $this->clearResults();
    }

    /**
     * Provides a method to ask and receieve feedback via the console.
     *
     * The feedback generates the *console_feedback_title* event when received.
     *
     * @event  console_feedback_{title}
     * @param  string  $title  Title of feedback expected.
     * @param  string  $feedback  Question to ask.
     * @param  array  $options  Options to pass to output method
     *
     * @return  void
     */
    public function feedback($title, $feedback, $options = array())
    {
        $defaults = array('block' => false);
        $options += $defaults;
        $this->output($feedback, $options);
        if ($options['block']) {
            stream_set_blocking(STDOUT, 0);
        }
        $input = trim(fgets(STDIN));
        if ($options['block']) {
            stream_set_blocking(STDOUT, 1);
        }
        $this->setListener("console_feedback_$title");
        $this->trigger(array($input));
        return true;
    }
}
</pre>
    </li>
    <li>
        <h3>
            modules/commands.php
        </h3>
        <p>
            The commands object will be the workhorse of our console working as the main interactive object receiving and dispatching commands from the
            console.
        </p>
<pre class="prettyprint linenums">
namespace iconsole;

/**
 * Iconsole Prggmr Interactive Console
 *
 * @author Nickolas Whiting
 * @date February 17th, 2011
 */

/**
 * The command objects is the main workhorse of the console as
 * it is responsible.
 */

class Commands extends \iconsole\Console
{
    // user object
    public $_user = null;

    /**
     * Constructs the command console
     */
    public function __construct(User $user) {

        $this->_user = $user;
        $this->command();
    }

    /**
     * Command  is used to recieve input from the console as a new "command"
     * which will attempt to trigger a method within itself as the executed
     * command.
     *
     * Demonstrated with the following psuedo
     *
     * $command->command();
     * recieve input : test
     * check for test method in commands object
     * if true
     *      run test method
     * else
     *      dispatch invalid command message
     *
     * rerun command method
     *
     * @return  void
     */
    public function command()
    {
        $this->feedback('command', "Your wish is my command : \n");
    }

    /**
     * A simple example command which is triggered via the "test_command" command
     *
     * This method will execute a "feedback" asking a simple question.
     *
     * @return  void
     */
    public function test_command()
    {
        $this->feedback('test_command', 'What do you want me to do now ?  ');
    }
}
</pre>
    </li>
    <li>
        <h3>
            modules/user.php
        </h3>
        <p>
            The user object will serve as the current user that is logged into the console.
        </p>
        <pre class="prettyprint linenums">
namespace iconsole;

/**
 * Iconsole Prggmr Interactive Console
 *
 * @author Nickolas Whiting
 * @date February 17th, 2011
 */

/**
 * The user object represents an actual user that exists on in the database.
 * Methods are provided for logging in the user and dispatching
 * events based on that user.
 */

class User extends \iconsole\Console
{
    // User account is active
    const STATE_USER_ACTIVE = 200;

    // User account is inactive
    const STATE_USER_INACTIVE = 201;

    // File containing the user for persistant activity
    const PERSISTANT_FILE = '/tmp/upcf.tmp';

    // Timespan in which the user remains logged.
    // default : 5 Minutes
    const TIMESPAN = 300;

    // username of current user
    public $_name = null;

    // password of current user
    public $_pass = null;

    // number of failed login attempts
    public $_attempts = 0;

    // user sqlite connection
    public $_db = null;

    // Constructs the user object dispatching the user login events
    public function __construct()
    {
        $this->_db = new \PDO('sqlite:'.PRGGMR_LIBRARY_PATH.'../../../databases/users.sqlite');
        if (file_exists(self::PERSISTANT_FILE)) {
            $user = trim(file_get_contents(self::PERSISTANT_FILE));
            $this->console_feedback_user_login(array($user));
        } else {
            $this->user_login();
        }
    }

    // dispatch the user_login feedback event
    public function user_login()
    {
        $this->feedback('user_login', "Enter your username : ", array('lb' => null));
    }

    // dispatch the user_login_validate event
    public function user_login_validate()
    {
        $this->feedback('user_login_validate', "Password : ", array('lb' => null));
    }
}
        </pre>
    </li>
</ul>
<h2>
    The Events
</h2>
<p>
    The events directory contains the files which include our event subscribers, this directory is automatically scanned and all files are included when the app is first run.
</p>
<ul>
    <li>
        <h3>
            events/console.commands.php
        </h3>
        <p>
            The commands file is used to house all subscriptions that will be bubbled from the iconsole\Commands event.
        </p>
        <pre class="prettyprint linenums">
/**
 * Subscription that is bubbled and acts as the command interrupter
 * suplement to the iconsole\Commands object.
 *
 * This subscription will check for the given command in the commands
 * object and run if it exists, once finished ( we dont konw when )
 * it will trigger the command action asking for another command to
 * be executed.
 *
 * @param  object  $event  iconsole\Commands
 * @param  string  $command  Command received from the command prompt
 *
 * @return  void
 */
\prggmr::listen('console_feedback_command', function($event, $command) {

    if (!method_exists($event, $command)) {
        $event->output("Invalid command recieved!\n");
    } else {
        $event->{$command}();
    }

    $event->command();
});


/**
 * This subscription is the response subscriber that will await for the
 * response from the "test_command" feedback publisher.
 *
 * This is not to be confused as the subscription that is bubbled when
 * the "test_command" is executed rather it is the subscription to the
 * "feedback" publisher that is bubbled once the "test_command" is
 * bubbled via the iconsole\Commands::test_command method.
 *
 * @param  object  $event  iconsole\Commands
 * @param  string  $command  String recieved from the command prompt
 *
 * @return  void
 */
\prggmr::listen('console_feedback_command_test_command', function($event, $command) {
    $event->output("You have just executed me with the input of : $command");
});
        </pre>
    </li>
    <li>
        <h3>
            events/console.output.php
        </h3>
        <p>
            The output events file will add subscriptions for when we output any data to the console.
        </p>
        <pre class="prettyprint linenums">
/**
 * Subscription that is bubbled when data is being requested for output
 * this acts as a filter allowing the data to be tampered with, if so choosen,
 * before dumping it to the console.
 *
 * @param  object  $event  iconsole\Commands
 * @param  string  $string  String that will be printed to the console.
 *
 * @return  string  String to be outputted to the console
 */
\prggmr::listen('console_output', function($event, $string){
    return $string;
});
        </pre>
    </li>
    <li>
        <h3>
            events/console.user.php
        </h3>
        <p>
            The user events file adds subscriptions for all user related events such as logins.
        </p>
        <pre class="prettyprint linenums">
/**
 * Subscription which handles the logging in of a user, this is done
 * outside of the iconsole\User object as we only prompt the user
 * for credentials from within the object and then hand the app logic
 * for producing the validated access to subscriptions if we needed
 * to ever expand this logic.
 *
 * @param  object  $event  iconsole\User
 * @param  string  $user  Username given to use as the login username
 *
 * @return  void
 */
\prggmr::listen('console_feedback_user_login', function($event, $user) {
    // We use SQLite database to store user logins
    // validate this user exists
    $query = $event->_db->prepare('SELECT pass FROM accounts WHERE name = ? LIMIT 1');
    $query->execute(array($user));
    $result = $query->fetchAll();
    // Set the username in the event object for later uses
    $event->_user = $user;
    if (count($result) == 0) {
        /**
         * user is non-existant set the event as inactive
         * and bubble the login_failure event.
         */
        $event->setState(\iconsole\User::STATE_USER_INACTIVE);
        $event->user_login_failure();
    } else {
        /**
         * User account exists we now pass the password into the
         * user event object and bubble the validate event.
         */
        $event->_pass = $result[0]['pass'];
        $event->user_login_validate();
    }
});


/**
 * Subscription which handles the authentication of a user's password.
 *
 * @param  object  $event  iconsole\User
 * @param  string  $password  Password given from the command prompt
 *
 * @return  void
 */
\prggmr::listen('console_feedback_user_login_validate', function($event, $password){
    if (sha1($password) === $event->_pass) {
        /**
         * Bubble the login success
         */
        $event->user_login_success();
    } else {
        /**
         * Bubble the login failure
         */
        $event->user_login_failure();
    }
});


/**
 * Subscription for when a user fails to authenticate themeselves,
 * this subscription will keep track of the number of times the user fails
 * and once they reach a set limit drop their console.
 *
 * @param  object  $event  iconsole\User
 *
 * @return  void
 */
\prggmr::listen('user_login_failure', function($event){
    if ($event->_attempts >= 4) {
        die();
    }
    $event->_attempts++;
    $event->user_login();
});


/**
 * Subscription for when a user successfully authenticates themeselves.
 * Here we will set the user event as active to indicate we have a active
 * account, write the users information to the persisantance file and display
 * the welcome message.
 *
 * @param  object  $event  iconsole\User
 *
 * @return  void
 */
\prggmr::listen('user_login_success', function($event){
    $event->setState(\iconsole\User::STATE_USER_ACTIVE);
    file_put_contents(\iconsole\User::PERSISTANT_FILE, $event->_user);
    $event->output(sprintf(
        "\nWelcome to Prggmr Iconsole %s\n
        ---------------------\nEnjoy your visit, and don't abuse the system!
        \n-------------------------\n\n",
        $event->_user
    ));
});
        </pre>
    </li>
</ul>
<h2>
    The console file
</h2>
<p>
    The console file acts as our bootstrap loading the Prggmr framework, modules and events and also serves as the entry point to the console.
</p>
<pre class="prettyprint linenums">
#!/usr/bin/php

/**
 * Iconsole Prggmr Interactive Console
 *
 * @author Nickolas Whiting
 * @date February 17th, 2011
 */

// Load the Prggmr Framework
set_include_path(getcwd() . DIRECTORY_SEPARATOR . get_include_path());
require 'lib/Prggmr/lib/prggmr.php';
\prggmr::initialize();

define('LINE_BREAK', "\n");

// Load our modules
require 'modules/console.php';
require 'modules/user.php';
require 'modules/commands.php';

// Run as glob and include as event files
foreach (glob("events/*.php") as $filename) {
    require $filename;
}

// Init the user object
$user = new \iconsole\User();
// Dispatch the console
$commands = new \iconsole\Commands($user);
</pre>
<h2>
    Overview
</h2>
<p>
    Prggmr iConsole is a example app built to demonstrate the possibilities of the Prggmr Framework, it really serves no real world purpose ... well until
    it is further developed, I hope you enjoyed this guide and if you have comments or suggestions post them below :)
</p>