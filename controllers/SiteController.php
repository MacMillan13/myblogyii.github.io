<?php

namespace app\controllers;

use Yii;
use yii\helpers\Html;
use yii\lters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Comment ;
use app\models\CommentForm;
use app\models\Article ;
use app\models\Category ;
use app\models\Tag ;
use app\models\ArticleTag ;
use yii\data\Pagination;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
    
    $data = Article::getAll(3);
    $popular = Article::getPopular();
    $recent = Article::getRecent();
    $categories = Category::getAll();

        return $this->render('index', [
                'articles'=>$data['articles'],
                'pagination'=>$data['pagination'],
                'popular'=>$popular,
                'recent'=>$recent,
                'categories'=>$categories
            ]);
    }
    public function actionView($id)
    {
        $article = Article::findOne($id);
        $tags = Tag::getTag($id);
        $popular = Article::getPopular();
        $recent = Article::getRecent();
        $categories = Category::getAll();
        $comments = $article->getArticleComments();
        $commentForm = new CommentForm();

        $article->viewedCounter();


        return $this->render('single', [
                'article'=>$article,
                'tags'=>$tags,
                'popular'=>$popular,
                'recent'=>$recent,
                'categories'=>$categories,
                'comments' =>$comments,
                'commentForm'=>$commentForm
            ]);
    }

    public function actionCategory($id)
    {
        $data = Category::getArticlesByCategory($id);
        $popular = Article::getPopular();
        $recent = Article::getRecent();
        $categories = Category::getAll();

        return $this->render('category',[
            'articles'=>$data['articles'],
            'pagination'=>$data['pagination'],
            'popular'=>$popular,
                'recent'=>$recent,
                'categories'=>$categories
            ]);
    }

    public function actionTag($id)
    {
        $data = Tag::getArticlesByTag($id);
        $popular = Article::getPopular();
        $recent = Article::getRecent();
        $tags = Tag::getTag();

        $categories = Category::getAll();

        return $this->render('tag',[
            'articles'=>$data['articles'],
            'pagination'=>$data['pagination'],
            'popular'=>$popular,
                'recent'=>$recent,
                'tags'=>$tags,
                'categories'=>$categories,

            ]);
    }


    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    public function actionForm()
    {
        $form = new NewRegist();

        if($form->load(Yii::$app->request->post()) && $form->validate())
        {
            $name = Html::encode($form->name);
            $email = Html::encode($form->email);

            $form->file = UploadedFile::getInstance($form,'file');
            $form->file->saveAs('photo/'. $form->file->baseName.'.'.$form->file->extension);
        }
        else
        {
            $name ='';
            $email ='';
        }
        return $this->render('form',
                ['form'=> $form,
                'name' => $name,
                'email'=>$email
                ]
            );
    }

    public function actionComment($id)
    {
        $model = new CommentForm();

        if(Yii::$app->request->isPost)
            {
                $model->load(Yii::$app->request->post());
                if($model->saveComment($id))
                {
                    Yii::$app->getSession()->setFlash('comment', 'Ваш комментарий скоро добавиться');
                    return $this->redirect(['site/view', 'id'=>$id]);
                }
            }
    }

}
