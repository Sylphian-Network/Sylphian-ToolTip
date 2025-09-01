<?php

namespace Sylphian\ToolTip\XF\Pub\Controller;

use XF;
use XF\Mvc\ParameterBag;
use XF\Mvc\Reply\Exception;
use XF\Mvc\Reply\View;
use XF\Pub\Controller\MemberController as XFMember;

class MemberController extends XFMember
{
    /**
     * @throws Exception
     */
    public function actionTooltip(ParameterBag $params): View
    {
        $this->assertNotEmbeddedImageRequest();

        $visitor = XF::visitor();
        $hasPermission = $visitor->hasPermission('general', 'viewProfileToolTip');

        if ($hasPermission) {
            $user = $this->assertViewableUser($params->user_id, [], true);
            $viewParams = [
                'user' => $user,
            ];

            return $this->view('XF:Member\Tooltip', 'member_tooltip', $viewParams);
        } else {
            return $this->view('XF:Member\Tooltip', 'no_permission_member_tooltip', []);
        }
    }
}