<?php

namespace Concrete\Package\Accessibility;
use Concrete\Core\Page\Event;
use Package;
use Events;
use User;
use Group;
use Concrete\Core\Html\Service\Html;
use View;
use Core;

class Controller extends Package {

    protected $pkgHandle = 'Accessibility';
    protected $appVersionRequired = '5.7';
    protected $pkgVersion = '0.1';

    public function getPackageDescription() {
        return t("A simple package to get those fancy text labels back on the edit toolbar");
    }

    public function getPackageName() {
        return t("Text Toolbar");
    }

    public function install() {
        parent::install();
    }

    public function on_start() {
        $u = new User();
        $g = Group::getByName("Administrators");
        if($u->inGroup($g) || $u->isSuperUser()) {
            Events::addListener('on_before_render', function(){
                    $view = View::getInstance();
                    $html = new Html();
                    $view->addHeaderItem(
                        $html->css(
                            "accessibility.css",
                            'accessibility'
                        )
                    );
                }
            );
        }
    }
}