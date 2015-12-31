<?php
/**
 * Adds autoupdate of the metadatafields on pagesave.
 * A checkbox is added to the Main Content tab to select wether to update the MetaDescription and MetaKeyword fields on save.
 * Default is set to yes
 *
 * You can adjust the amount of keywords, minimal word character and wich words to exclude in _config.php
 * 
 * @Author Martijn van Nieuwenhoven
 * @Alias Marvanni
 * @Email info@axyrmedia.nl
 *
 * @Silverstripe version 3
 * @package MetaManagerExtension
 **/

class MetaManagerExtension extends SiteTreeExtension
{
    
    /**
     * @var int 
     **/
    public static $keyword_amount = 15;
    
    /**
     * @var int
     **/
    public static $min_word_char = 4;

    /**
     * @var string
     **/
    public static $exclude_words = '';
    
    /**
     * @var bool
     **/
    public static $checkbox_state = 1;

    /** 
     * @var int
     **/
    protected static $meta_desc_length = 255;

    /**
     * @var bool
     **/
    public static $hide_extra_meta = 0;


    private static $db = array(
        'GenerateMetaData' => 'Int'
    );
    
    private static $defaults = array(
        'GenerateMetaData' => 1
    );
    
    public function updateCMSFields(FieldList $fields)
    {
        $fields->insertBefore(
            new CheckboxField('GenerateMetaData',
                _t('MetaManager.GENERATEMETADATA', 'Generate Meta-data automatically from the page content'),
                $this->owner->GenerateMetaData
            ),
            'MetaDescription'
        );
        
        if (self::$hide_extra_meta == 1) {
            $fields->removeByName('ExtraMeta');
            $fields->removeByName('ExtraMeta_original');
        }
    }
    
    /**
     * Update Metadata fields function
     */
    public function onBeforeWrite()
    {
        parent::onBeforeWrite();
        
        if ($this->owner->ID && $this->owner->GenerateMetaData) {
            $this->owner->MetaTitle = strip_tags($this->owner->Title);
            
            $this->owner->MetaDescription = html_entity_decode(strip_tags($this->owner->Content), ENT_COMPAT, 'UTF-8');
            if (self::$meta_desc_length > 0 && strlen($this->owner->MetaDescription) > self::$meta_desc_length) {
                $this->owner->MetaDescription = substr($this->owner->MetaDescription, 0, self::$meta_desc_length) . "...";
            }
            // calculateKeywords
            $this->owner->MetaKeywords = MetaGenerator::generateKeywords(
                                            $this->owner->Content,
                                            self::$min_word_char,
                                            self::$keyword_amount,
                                            self::$exclude_words
                                        );
        }
    }
}
