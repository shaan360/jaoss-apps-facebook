<?php

require_once("apps/facebook/helpers/auth/auth.php");
require_once("apps/facebook/helpers/graph/graph.php");

class FacebookController extends Controller {
    protected $user = null;

    public function init() {
        parent::init();

        $this->user = Table::factory('FacebookUsers')->loadFromSession();

        if (!$this->user->isAuthed()) {

            $fbAuth  = FacebookAuth::getInstance();

            $signedRequest = $this->request->getVar("signed_request");

            if ($this->request->isPost() && $signedRequest != null) {

                try {
                    $data = $fbAuth->parseSignedRequest($signedRequest);

                    Log::debug("Got signed request: [".json_encode($data)."]");

                    $fbAuth->setData($data);

                    if ($fbAuth->isAuthed()) {
                        Log::debug("Authenticating user based on signed request");

                        $fbGraph = FacebookGraph::getInstance();

                        $fbGraph->setAccessToken(
                            $fbAuth->getOauthToken()
                        );

                        $data = $fbGraph->get('me');

                        $user = Table::factory('FacebookUsers')->read($data['id']);
                        if (!$user) {
                            Log::debug("No user in DB with ID [".$data['id']."], creating...");
                            $user = Table::factory('FacebookUsers')->newObject();
                        } else {
                            Log::debug("User [".$data['id']."] already exists, updating...");
                        }

                        // regardless of whether we're new or existing, update all our values
                        $user->setValues(array(
                            'id'       => $data['id'],
                            'forename' => $data['first_name'],
                            'surname'  => $data['last_name'],
                        ));
                        $user->save();
                        $user->setAuthed(true);
                        $user->addToSession();

                        $this->user = $user;
                    }
                } catch (FacebookAuthException $e) {
                    Log::warn("Got Facebook Auth exception [".$e->getCode()."] - [".$e->getMessage()."]");
                    // @todo anything else?
                    $this->assign('authError', true);
                } catch (FacebookGraphException $e) {
                    Log::warn("Got Facebook Graph exception [".$e->getCode()."] - [".$e->getMessage()."]");
                    // @todo anything else we need to do here? Set an error so the template knows? etc.
                    $this->assign('graphError', true);
                }
            }
        } else {
            Log::debug("User [".$this->user->getId()."] already signed in, skipping FB auth");
        }

        $this->assign('user', $this->user);

        $this->response->addHeader("P3P", 'CP="CAO PSA OUR"');
    }

    public function index() {
        if (!$this->user->isAuthed()) {
            $fbAuth = FacebookAuth::getInstance();
            Log::debug("User not authed, auth URL [".$fbAuth->getAuthUrl()."]");
            $this->assign('authUrl', $fbAuth->getAuthUrl());
        }

        return $this->render("index");
    }
}
