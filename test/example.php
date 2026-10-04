<?php

require dirname(__FILE__).'/../src/BibtexWriter.php';
require dirname(__FILE__).'/../src/Entry.php';

use \com\augmentedlogic\bibtex\BibtexWriter;
use \com\augmentedlogic\bibtex\Entry;

$bw = new BibtexWriter();

$entry = new Entry("article", "johndoe2026");
$entry->setTitle("A random title of a paper dealing with something")
      ->setAuthor("John Doe")
      ->setJournal("Nature")
      ->setYear(2026)
      ->setMonth("august");

$entry2 = new Entry("misc");
$entry2->setTitle("A document showing escaping the journal name")
       ->setAuthor("Jane Doe")
       ->setJournal("Biology & Physics")
       ->setYear(2026)
       ->setMonth(8)
       ->setUrl("https://www.misalignedmag.com/article/whatever");


$bw->add($entry);
$bw->add($entry2);

//$bw->preserveUpper();

$bw->render();

print $bw->asString();

//$bibtexWriter->write("out.bib");


$bw2 = new BibtexWriter();
$bw2->add($entry);
$bw2->add($entry2);
$bw2->useQuotes();
$bw2->render();
print $bw2->asString();
