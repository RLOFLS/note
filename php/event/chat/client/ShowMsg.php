<?php
use UI\Area;;
use UI\Size;
use UI\Executor;
use UI\Point;

use UI\Controls\Box;

use UI\Draw\Pen;
use UI\Draw\Brush;
use UI\Draw\Brush\LinearGradient;
use UI\Draw\Path;
use UI\Draw\Color;
use UI\Draw\Stroke;
use UI\Draw\Matrix;

use UI\Draw\Text\Font;
use UI\Draw\Text\Font\Descriptor;
use UI\Draw\Text\Layout;


class ShowMsg extends Area
{
    protected $executor;

    protected $msg = [];

    private $randColor = 0;

    protected $colors = [
        0x8F3AA4FF,
        0xCD116AFF,
        0x119ACDFF,
        0x65CD11FF,
        0xE64C00FF,
        0xE2B500FF
    ];

    private $bgSize;
    private $bgPoint;

    public function __construct(Box $box)
    {
        $box->append($this, true);
    }

    public function setMsg(array $msg)
    {
        $this->msg = $msg;
    }

    public function setExecutor(Executor $executor)
    {
        $this->executor = $executor;
    }

    protected function onDraw(Pen $pen, Size $size, Point $clip, Size $clipSize)
    {
        $size->setHeight($size->getHeight());
        $size->setWidth($size->getWidth());
        $this->bgDraw($pen, $size);
        $this->msgDraw($pen);
        $this->executor->setInterval(1000000);
    }

    /**
     * 展示消息
     * create on 2020/6/22
     * @param Pen $pen
     */
    public function msgDraw(Pen $pen)
    {
        $initPoint = new Point($this->bgPoint->getX() + 10, $this->bgPoint->getY()+10);
        foreach ($this->msg ?? [] as $msg) {
            $this->oneMsgDraw($pen, $initPoint, $msg);
            $len = (bcdiv(mb_strlen($msg) * 12 , $this->bgSize->getWidth()-20) + 1) * 12;
            $initPoint->setY($initPoint->getY() + $len);
        }
    }

    /**
     * 展示一条消息
     * create on 2020/6/22
     * @param Pen   $pen
     * @param Point $point
     * @param       $msg
     */
    private function oneMsgDraw(Pen $pen, Point $point, $msg)
    {
        $layout = new Layout(sprintf(
            "msg: %s",
            $msg
        ), new Font(new Descriptor("arial", 12)), $this->bgSize->getWidth()-20);

        $layout->setColor($this->colors[rand(0, $this->randColor)]);

        $pen->write($point, $layout);
    }


    /**
     * 刻画背景
     * create on 2020/6/22
     * @param Pen  $pen
     * @param Size $size
     */
    private function bgDraw(Pen $pen, Size $size)
    {
        $point = new Point(0, 0);
        $point->setY($point->getY() + 40);

        $bgSize = $size;
        $bgSize->setHeight($bgSize->getHeight());
        $bgSize->setWidth($bgSize->getWidth());

        $this->bgSize = $bgSize;
        $this->bgPoint = $point;
        $path = new Path();
        $path->addRectangle($point, $bgSize);
        $path->end();

        $pen->fill($path, 0xf5f5f5ff);
        $stroke = new Stroke();
        $pen->stroke($path, 0x000000FF, $stroke);
    }
}