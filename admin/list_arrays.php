/* Arrays containing lists. */
var all_tags = <?php print("$all_subjects")?>;
autocomplete(document.getElementById("subject1"), all_tags);
autocomplete(document.getElementById("subject2"), all_tags);
autocomplete(document.getElementById("subject3"), all_tags);

var all_author = <?php print("$all_authors") ?>;
autocomplete(document.getElementById("author_full"), all_author);

