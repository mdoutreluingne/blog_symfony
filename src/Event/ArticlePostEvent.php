<?php 

namespace App\Event;

use App\Entity\Article;
use Symfony\Contracts\EventDispatcher\Event;

class ArticlePostEvent extends Event
{
    const NAME = 'article.new';

    /**
     *
     * @var Article
     */
    private $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * Get the value of article
     *
     * @return  Article
     */ 
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set the value of article
     *
     * @param  Article  $article
     *
     * @return  self
     */ 
    public function setArticle(Article $article)
    {
        $this->article = $article;

        return $this;
    }
}

?>