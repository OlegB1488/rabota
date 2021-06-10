<?php
namespace frontend\controllers;

use frontend\models\Otklik;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\bootstrap\ActiveForm;
use yii\db\ActiveRecord;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\Vacancy;
use frontend\models\ProfileRd;
use frontend\models\ProfileStudent;
use frontend\models\Rezume;
use frontend\models\Mesto;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

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



    public function actionIndex()
    {
    	$model = Vacancy::find()->all();
    	$otklik = new Otklik();
        if ($otklik->load(Yii::$app->request->post())) {
            $otklik->id_user = Yii::$app->user->identity->id;
            $otklik->save();
        }
        return $this->render('index', ['model' => $model, 'otklik' => $otklik]);


    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }

    public function actionProfilerd()
    {
        if (!Yii::$app->user->can('rd')){
            return $this->goHome();
        }
        $model = new ProfileRd();
        if ($model->load(Yii::$app->request->post())) {
            $model->id_user = Yii::$app->user->identity->id;
        $model->save();
        return $this->goHome();
        }
        return $this->render('profilerd', [
            'model' => $model
        ]);
    }

    public function actionProfilestudent()
    {
        if (!Yii::$app->user->can('student')){
            return $this->goHome();
        }
        $model = new ProfileStudent();
        $query = $model->find()->where(['id_user'=>Yii::$app->user->identity->id])->one();
        $bool = false;
        if (!empty($query)){
            $model = $query;
            $bool = true;
        }
        if ($model->load(Yii::$app->request->post())) {
            $model->id_user = Yii::$app->user->identity->id;
            if ($bool){
                $model->update();
            }
            else{
                $model->save();
            }
            return $this->goHome();
        }
        return $this->render('profilestudent', [
            'model' => $model
        ]);
    }

    public function actionOtklikstudent()
    {
        $model = new Otklik();
        $query = $model->find()->where(['id_user'=>Yii::$app->user->identity->id])->all();
        return $this->render('otklikstudent', [
            'model' => $query
        ]);
    }

    public function actionOtklikrdapi()
    {
        $model = new Otklik();
        $query = $model->find()->all();
        $model2 = new Rezume();
        $rezumeq = $model2->find()->all();
        $response = [];
        $i = 0;
        foreach ($query as $vacancy) {
            if ($vacancy->vacancy->id_user == Yii::$app->user->identity->id)
            {
                foreach ($rezumeq as $rezume){
                    if ($rezume->id_user == $vacancy->id_user){
                        $response[$i] = ['title' => $vacancy->vacancy->title, 'zp' => $vacancy->vacancy->zp, 'rezu' => $rezume->text];
                        $i++;
                    }
                }
            }
        }
//        return $this->render('otklikrd', [
//            'model' => $query,
//            'model2' => $rezume
//        ]);
        return json_encode($response, JSON_UNESCAPED_UNICODE);
    }

    public function actionOtklikrd(){
        return $this->render('otklikrd');
    }

    public function actionMesto(){
        $mesto=new Mesto();
        if ($mesto->load(Yii::$app->request->post())) {
            $mesto->id_user=Yii::$app->user->identity->id;
            $mesto->save();
            $mesto=new Mesto();
        }
        return $this->render('mesto', [
            'model' => $mesto
        ]);

    }
}
