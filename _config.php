<?php

Object::add_extension('SiteTree', 'MetaManagerExtension');

// english and swedish
MetaManagerExtension::$exclude_words = 'about, again, also, been, before, cause, come, could, does, each, even, from, give, have, here, just, like, made, many, most, much, must, only, other, said, same, should, since, some, such, tell, than, that, their, them, then, there, these, they, thing, this, through, very, want, well, were, what, when, where, which, while, will, with, within, would, your, att, även, ber, bli, blir, den, denna, denne, dessutom, det, detta, dig, din, ditt, dock, där, eller, ett, ett, får, för, från, går, ger, har, hos, inte, kan, kommer, med, men, och, också, oss, samt, sitt, ska, skall, skulle, som, stå, säger, tar, tas, till, vår, våra, vårt, vara, vid, vill';
 
/**
 * Set wether to hide the ExtraMeta field
 * @param bool $hide_extra_meta 
 **/
MetaManagerExtension::$hide_extra_meta = 1;