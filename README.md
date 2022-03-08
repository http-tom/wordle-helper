# Wordle Cracker

Gives suggestions to help with solving Wordle puzzles.

Can be run via commandline or via web interface.

### Command line

`php wordle.php` for usage instructions which are:

Usage: `php wordle.php a e i _o _u \"[i a e]\"`    where _prefixed letters will exclude words with those characters. A parameter inside square brackets will match the position of those characters in the word. Use keyword random to provide a word suggestion. 

`php wordle.php random` to get a random suggestion

`php wordle.php ight` to get all words with ight in them

