<?php
use Melbahja\Seo\MetaTags;

class SEO{
    protected $metatags;

    public function __construct() {
        $this->metatags = new MetaTags();
    }
    /*
    result:

    <title>PHP SEO</title>
    <meta name="title" content="PHP SEO" />
    <meta name="description" content="This is my description" />
    <meta name="author" content="Mohamed Elabhja" />
    <link href="https://m.example.com" rel="alternate" media="only screen and (max-width: 640px)" />
    <link rel="canonical" href="https://example.com" />
    <link rel="shortlink" href="https://git.io/phpseo" />
    <link rel="amphtml" href="https://apm.example.com" />
    <meta property="twitter:title" content="PHP SEO" />
    <meta property="twitter:description" content="This is my description" />
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:image" content="https://avatars3.githubusercontent.com/u/8259014" />
    <meta property="og:title" content="PHP SEO" />
    <meta property="og:description" content="This is my description" />
    <meta property="og:image" content="https://avatars3.githubusercontent.com/u/8259014" />
    */
    public function create(){
        $metatags = $this->metatags;
        $metatags->title('PHP SEO')
            ->description('This is my description')
            ->description('This is my description 2')
            ->meta('author', 'Mohamed Elabhja')
            ->image('https://avatars3.githubusercontent.com/u/8259014')
            ->mobile('https://m.example.com')
            ->canonical('https://example.com')
            ->shortlink('https://git.io/phpseo')
            ->amp('https://apm.example.com');
        
        return $metatags;
    }
}