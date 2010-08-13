<?php $data = array (
  'topic' => 
  array (
    0 => 
    array (
      'attributes' => 
      array (
        'id' => 'journal/topic/000028',
        'locale' => 'en_US',
        'title' => 'Contexts',
        'toc' => 'journal/toc/000005',
        'key' => 'journal.managementPages.readingTools.contexts',
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
      'value' => '<p>Each set of Reading Tools is made up of individual tools (e.g., Related Studies, Online Forums, etc.) with each tool consisting of a number of relevant databases. These databases can be added, edited or deleted. The groupings can also be reordered.</p><p><i>Metadata for items in a grouping</i>. The Journal Manager can alter the title of the tool. It also provides an option to determine whether the author\'s keywords (the default) or the author\'s name (e.g., for use with Author\'s Other Works) will be used for the searching of the database. A second option, used with Define Terms, allows the reader to select the search term by double clicking on any word in the text of the item being read in the journal. Journal Managers can use these options in building their own reading tools.</p><p><i>Edit searches for each tool</i>. Using Search, the Journal Manager can edit or delete the search URL for each database in a tool, as well as reorder the databases that appear in the tool. For each database, a URL is provided that will enable the reader to learn more about the database, and a URL for that enables the search to be conducted using the author\'s keywords or the author\'s name (See Metadata under Contexts in Reading Tools). There are two types of searches that can be set up, a GET search, and if that will not work with the database a POST search.</p>',
    ),
    1 => 
    array (
      'attributes' => 
      array (
        'title' => 'GET Searches',
      ),
      'value' => '<p>For GET searches, run a search and look at the resulting URL. E.g., on Google, a search for "FOOBAR" gives the URL</p><p><samp class="code">http://www.google.ca/search?hl=en&q=FOOBAR&meta=</samp></p><p>Since we need the parameter that specifies the search term to appear last in the URL, we can shuffle the parameters in the GET query string to give</p><p><samp class="code">http://www.google.ca/search?hl=en&meta=&q=FOOBAR</samp></p><p>giving us a search URL of</p><p><samp class="code">http://www.google.ca/search?hl=en&meta=&q=</samp></p><p>for the RT. However, since the other parameters are unnecessary in this case, we can use a simplified URL of</p><p><samp class="code">http://www.google.ca/search?q=</samp></p><p>for the RT.</p>',
    ),
    2 => 
    array (
      'attributes' => 
      array (
        'title' => 'POST Searches',
      ),
      'value' => '<p>For POST forms, it is more complicated. Again, looking at Google, you can view the page\'s source, and notice<samp class="code">&lt;form action="/search" ...&gt;</samp>, giving us a starting base URL of<samp class="code">http://www.google.com/search</samp>. You can then look at each of the<samp class="code">&lt;input ...&gt;</samp> and<samp class="code">&lt;select ... &gt;</samp> elements in the form, and add them as<samp class="code">name=value</samp> pairs separated by<samp class="code">&</samp> to the end of the URL. The element that specifies the textbox that accepts user-entered text (in Google\'s case, named<samp class="code">q</samp>), should go at the end of the URL as<samp class="code">name=</samp>. So for Google we get<samp class="code">http://www.google.com/search?q=</samp>.</p><p>A somewhat easier way for POST forms is to copy the HTML source to a file, change<samp class="code">method=post</samp> to<samp class="code">method=get</samp> in the appropriate form field, and change the form\'s<samp class="code">action=</samp> value such that it is a complete URL, e.g.,<samp class="code">http://www.google.com/search</samp> rather than just<samp class="code">/search</samp>. You can then view the modified HTML file in your browser and use the GET method above to construct the URL.</p><p>As some search engines do not support GET queries, if you find that the above method does not work, you can enter POST form data in the "Search post data" field. If the example given above required that the data be posted, you would enter<samp class="code">http://www.google.com/search</samp> for the search URL and<samp class="code">q=</samp> for the post data. Note that the parameter specifying the term to be searched must always come last in the post data, if applicable, and otherwise last in the search URL field.</p><p>Make sure you test the URLs make sure they work correctly, by appending a term to the URL and testing it to see if it shows the expected search results. Note that with POST forms this might not always be possible, depending on the site. For URLs that don\'t have proper search engines another possibility is to use Google and restrict by site. You can use a query like<samp class="code">site:mysite.com FOOBAR</samp> in Google to search for the term "FOOBAR" only within mysite.com. This is used in the current RTs for several sites.</p>',
    ),
  ),
); ?>