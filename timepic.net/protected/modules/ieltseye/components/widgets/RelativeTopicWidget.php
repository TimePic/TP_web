<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RelativeTopic
 *
 * @author lixiaoxin
 */
class RelativeTopicWidget extends CWidget {

    public $id;
    public $type=0;//1 2 3
    public $limit=10;
    public $data;
    public $cache = true;
    public $cacheTime = 3600;
    

    public function init() {
        if ($this->id) {
            $this->data = Yii::app()->cache->get('RelativeTopicWidget_id_'.$this->id);
            if ($this->cache && $this->data) {
                $this->data = Yii::app()->cache->get('RelativeTopicWidget_id_'.$this->id);
            }else{
                $itemIds = IeltseyeTagitem::model()->findAll('idtype="cardid" AND itemid=:itemid', array(':itemid'=>$this->id));
                foreach ($itemIds as $itemId) {
                   $itemTagids[] = $itemId->tagid; 
                }
                $itemTagids = array_unique($itemTagids);
                $command = Yii::app()->db->createCommand()
                    ->select('t.itemid, c.type, c.question, c.cardid')
                    ->from("{{ieltseye_tagitem}} t")
                    ->leftJoin("{{ieltseye_speaking_topic_card}} c", 't.itemid=c.cardid');
                $command->where(array('in','t.tagid', $itemTagids));
                $command->andWhere("t.itemid!=".$this->id);
                // same part with target
                if ($this->type) {
                    $command->andWhere("type=:part", array(":part"=>$this->type));
                }
                $command->order("c.type ASC")->limit($this->limit);
                $this->data = $command->queryAll();
                if ($this->cache) {
                    Yii::app()->cache->set('RelativeTopicWidget_id_'.$this->id, $this->data, $this->cacheTime);
                }
            }

                


//            $this->data = IeltseyeTagitem::model()->with('card'
//                )->findAllByAttributes(array('idtype'=>'cardid', 'tagid'=>$itemTagids));
        }
    }

    public function run() {
        $this->render('RelativeTopicWidget', array(
            'data'=>$this->data,
        ));
    }

}

?>