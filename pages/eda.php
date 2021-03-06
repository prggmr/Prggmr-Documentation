<!--
[PRGGMR
@title The Event Driven Architecture
@link event-driven-architecture
@category About
]
-->
<h2>
    The Event Driven Architecture
</h2>
<p>
    Software engineers have used and understood events for decades, and in recent light event driving systems are becoming
    a viable solution for developing enterprise applications as developers begin to utilize the relatively old concept.
</p>
<p>
    At the basic form an event can be defined as "a change". This can be described as almost anything within an applications code,
    for example a product is sold, a user logs in or a comment is posted.
</p>
<h2>
    Structure of an event driving architecture
</h2>
<p>
    The structure of an EDA can be described in three basic parts.
</p>
<ul>
    <li>
        <h3>
            Event Engine
        </h3>
        <p>
            The application logic which process events, listens for subscribers and recieves events from publishers.
        </p>
    </li>
    <li>
        <h3>
            Publisher
        </h3>
        <p>
            Application code which sends signals to the event engine to bubble events.
        </p>
    </li>
    <li>
        <h3>
            Subscribers
        </h3>
        <p>
            Application code which is triggered via the event engine when a signal is received from a publisher.
        </p>
    </li>
</ul>
<h2>
    Event processing styles
</h2>
<p>
    For the purpose of this guide it will cover the style of event processing used with the framework.
</p>
<ul>
    <li>
        <h3>
            Simple event processing
        </h3>
        <p>
            Is the processing of events that are directly related to changes within an application, this type of processing
            allows for real-time changes to be published asynchronously.
        </p>
    </li>
</ul>
<p>
    Now that we have covered the basic fundamentals of the event driven architecture lets move on learning the Prggmr API with
    the <a href="<?=plink('/hello_events')?>" rel="guide">Hello Events Tutorial</a>.
</p>