<?php

spl_autoload_register(function ($class_name) {
    require_once $class_name . '.php';
});

define ("PHP_UI_SECOND",    1000000);
define ("PHP_UI_SNAKE_FPS", 30);

/*
 * Wizard sample layout builded with PHP UI
 */

use UI\Window;
use UI\Size;
use UI\Point;
use UI\Area;

use UI\Controls\Button;
use UI\Controls\Grid;
use UI\Controls\Box;
use UI\Controls\Form;
use UI\Controls\Entry;
use UI\Controls\Label;
use UI\Controls\MultilineEntry;
use UI\Controls\Group;


/*
 * The window
 */
$window = new ChatWindow('聊天框', new Size(840, 680), TRUE);
$window->setMargin(true);

$box = new Box(Box::Horizontal);
$box->setPadded(true);


//$showMsg = new ShowMsg($box);
//$showMsg->scrollTo(new Point(500, 40), new Size(20, 30));
////$showMsg->setSize(new Size(840 - 280, 680 - 230));
//$msgExecutor = new MsgExecutor($showMsg);
//$showMsg->setExecutor($msgExecutor);
//$window->addExecutor($msgExecutor);


//聊天内容显示
$msgGroup = new Group('聊天内容：');
$msgGroup->setMargin(true);
$mulEntry = new MultilineEntry(MultilineEntry::Wrap);
$mulEntry->setReadOnly(true);

$tcpClient = new TcpClient($window);

//设置持行器
$msgShowExecutor = new MsgShowExecutor($mulEntry, $tcpClient);
$msgShowExecutor->setInterval(1000000);
$window->addExecutor($msgShowExecutor);

$msgGroup->append($mulEntry);
//$box->append($mulEntry, true);

$grid = new Grid();
$grid->setPadded(true);

//聊天人员显示
$olGroup = new Group('聊天人员：');
$olGroup->setMargin(true);
$olPeople = new MultilineEntry(MultilineEntry::Wrap);
$olPeople->setReadOnly(true);
$olGroup->append($olPeople);

$peopleShowExecutor = new PeopleShowExecutor($olPeople, $window);
$peopleShowExecutor->setInterval(2000000);
$window->addExecutor($peopleShowExecutor);

//$tcpClient->close();

//输入框
$putGroup = new Group('输入框：');
$putGroup->setMargin(true);
$putEntry = new MultilineEntry(MultilineEntry::NoWrap);
$putGroup->append($putEntry);

//发送按钮
$rightBtnBox = new Box(Box::Horizontal);
$rightBtnBox->append(new SendButton('发送', $putEntry, $tcpClient));

//布局
$grid->append($msgGroup ,0 , 1, 6, 80,  true, Grid::Fill, true, Grid::Fill);
$grid->append($olGroup , 6 , 1 , 1, 80, true, Grid::Fill, false, Grid::Fill);
$grid->append($putGroup , 0, 82 , 8, 30, false, Grid::Fill, false, Grid::Fill);
$grid->append($rightBtnBox , 6 , 112 , 1, 1, false, Grid::End, false, Grid::End);
//发送消息

$window->add($grid);
$window->show();

UI\run();