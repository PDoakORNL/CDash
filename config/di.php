<?php

use CDash\Messaging\Topic\AuthoredTopic;
use CDash\Messaging\Topic\BuildErrorTopic;
use CDash\Messaging\Topic\BuildWarningTopic;
use CDash\Messaging\Topic\ConfigureErrorTopic;
use CDash\Messaging\Topic\DynamicAnalysisTopic;
use CDash\Messaging\Topic\FixedTopic;
use CDash\Messaging\Topic\GroupMembershipTopic;
use CDash\Messaging\Topic\LabeledTopic;
use CDash\Messaging\Topic\TestFailureTopic;
use CDash\Messaging\Topic\UpdateErrorTopic;

return [
    'AuthoredTopic' => DI\object(AuthoredTopic::class)->scope(DI\Scope::SINGLETON),
    'BuildErrorTopic' => DI\object(BuildErrorTopic::class)->scope(DI\Scope::PROTOTYPE),
    'BuildWarningTopic' => DI\object(BuildWarningTopic::class)->scope(DI\Scope::PROTOTYPE),
    'ConfigureErrorTopic' => DI\object(ConfigureErrorTopic::class)->scope(DI\Scope::PROTOTYPE),
    'DynamicAnalysisTopic' => DI\object(DynamicAnalysisTopic::class)->scope(DI\Scope::PROTOTYPE),
    'FixedTopic' => DI\object(FixedTopic::class)->scope(DI\Scope::PROTOTYPE),
    'GroupMembershipTopic' => DI\object(GroupMembershipTopic::class)->scope(DI\Scope::PROTOTYPE),
    'LabeledTopic' => DI\object(LabeledTopic::class)->scope(DI\Scope::PROTOTYPE),
    'TestFailureTopic' => DI\object(TestFailureTopic::class)->scope(DI\Scope::PROTOTYPE),
    'UpdateErrorTopic' => DI\object(UpdateErrorTopic::class)->scope(DI\Scope::PROTOTYPE),
];
