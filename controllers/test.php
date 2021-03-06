<?php

require_once("apps/facebook/helpers/auth/auth.php");

class TestController extends Controller {
    public function iframe() {
        return $this->render("test/iframe");
    }

    public function auth() {
        return $this->render("test/auth");
    }

    public function encode() {
        if ($this->request->isPost()) {
            FacebookAuth::getInstance("test");
            $handler = new TestFacebookAuthHandler();

            $data = json_decode($this->request->getVar("data"), true);

            $signedRequest = $handler->encodeSignedRequest(
                $data,
                Settings::getValue("facebook", "app_secret")
            );

            $this->assign('signed_request', $signedRequest);
            try {
                $this->assign('decoded_request', $handler->parseSignedRequest(
                    $signedRequest,
                    Settings::getValue("facebook", "app_secret")
                ));
            } catch (FacebookAuthException $e) {
                // signed request didn't decode; that's probably okay, the user
                // might *want* to generate an invalid one to test
                $this->assign('bad_request', true);
            }
        }
        return $this->render("test/encode");
    }
}
