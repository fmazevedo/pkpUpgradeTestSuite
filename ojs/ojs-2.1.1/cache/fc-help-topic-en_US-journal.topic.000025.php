<?php return array (
  'topic' => 
  array (
    0 => 
    array (
      'attributes' => 
      array (
        'id' => 'journal/topic/000025',
        'locale' => 'en_US',
        'title' => 'Subscriptions',
        'toc' => 'journal/toc/000001',
        'key' => 'journal.managementPages.subscriptions',
      ),
      'value' => '',
    ),
  ),
  'section' => 
  array (
    0 => 
    array (
      'attributes' => 
      array (
      ),
      'value' => '<p>OJS supports subscription journals by providing a subscription management component and a corresponding password protection for the journal\'s online content. The subscriptions can be managed for individual users, organizations or institutions. A subscription journal can also offer free access to its back issues through a form of delayed open access. In Issue Management, the Editor allows readers free access to the content of an issue or individual articles from zero to 24 months after their initial publication and availability to subscribers.</p></p><p>A journal\'s Managers, Editors, Section Editors, Layout Editors, Copyeditors, and Proofreaders are always free to access the journal as though they were subscribers.</p><p><i>Deploying the subscription module</i>. The Journal Manager must indicate in Setup, 4.3 Subscription Management, that the journal will be using this system to manage its subscriptions and that someone, enrolled as a Journal Manager or Subscription Manager, has been designated to manage this feature.</p>',
    ),
    1 => 
    array (
      'attributes' => 
      array (
        'title' => 'Subscription Types',
      ),
      'value' => '<p><i>Setting up the Subscription Types</i>. The first step in setting up the subscription management is to designate the types of subscriptions the journal offers. Journals typically offer, for example, individual subscription and institutional subscription rates. Some journals may have special offers for members of an organization or students. OJS will support the management of print and/or online subscriptions. More than one type of subscription can be created to cover longer periods of time (12 months, 36 months).</p><p><i>Options for Subscription Types</i>. For "institutional" subscriptions, use the "validated via domain or IP authentication" option, as all members of the institution, coming in from its associated domain or IP address, will be permitted access without a password. Similarly, the "members of an association or organization" option should be used for membership subscriptions, whether free to members or at a discount.  Use the "publicly visible" option to make the subscription type and its fee appear under Subscriptions on the About the Journal. While most subscription types are typically displayed in About, a type created for internal accounting, staff subscriptions, and/or management purposes, for example, would not appear on the About page.</p>',
    ),
    2 => 
    array (
      'attributes' => 
      array (
        'title' => 'Subscriptions',
      ),
      'value' => '<p><i>Creating Subscriptions</i>. For individual subscribers, the Journal (Subscription) Manager has to register the subscriber as a reader, if not already registered, and then on the Create Subscriptions page, enter the type and dates for the subscription. On saving this information, the subscriber will be emailed a username, which will work with all content the journal publishes until the user is deleted from the Subscriptions list by the Journal Manager.</p><p><i>Institutional and organizational subscriptions</i>. For institutional subscriptions, the contact person at the institution needs to be enrolled as a reader, and then selected by the Journal (Subscription) Manager on the Create Subscriptions page. The contact person will need to provide the institution\'s domain and/or IP addresses, which are used to validate the account, sparing individual users at the institution the need to have user accounts in order to access subscription content. Organizations with membership lists can have those lists imported into the system, through the Import User function in Journal Management.</p>',
    ),
  ),
); ?>