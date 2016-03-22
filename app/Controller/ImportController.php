<?php

App::uses('AppController', 'Controller');

class ImportController extends AppController {

    public $uses = array(
        'Region',
    );

//    public function region() {
//
//        header('Content-Type: text/html; charset=utf-8');
//
//        App::import('Vendor', 'simplehtmldom', array('file' => 'simplehtmldom' . DS . 'simple_html_dom.php'));
//        $file_import = APP . 'tmp' . DS . 'docs' . DS . 'DMHC04.htm';
//
//        $html = file_get_html($file_import);
//        $parent_weight = 1;
//        $parent_id = null;
//        foreach ($html->find('tr') as $tr_index => $tr) {
//
//            if ($tr_index == 0) {
//
//                continue;
//            }
//
//            if (!empty($tr->find('span[style=color:blue]'))) {
//
//                $plain_parent = $tr->find('span[style=color:blue]', 0)->plaintext;
//                $pretty_parent = html_entity_decode(trim(explode('.', $plain_parent, 2)[1]));
//                $parent_name = $this->fix2WhiteSpace($pretty_parent);
//
//                $parent_data = array(
//                    'name' => $parent_name,
//                    'weight' => $parent_weight,
//                );
//
//                $this->Region->create();
//                $this->Region->save($parent_data);
//                $parent_weight ++;
//
//                $parent_id = $this->Region->getLastInsertID();
//            } elseif (!empty($tr->find('td')) && count($tr->find('td')) == 2) {
//
//                $weight = (int) $tr->find('td', 0)->find('b', 0)->plaintext;
//                $plain_name = $tr->find('td', 1)->find('b', 0)->plaintext;
//                $pretty_name = $this->fix2WhiteSpace(html_entity_decode($plain_name));
//
//                $save_data = array(
//                    'name' => $pretty_name,
//                    'weight' => $weight,
//                    'parent_id' => $parent_id,
//                );
//
//                $this->Region->create();
//                $this->Region->save($save_data);
//            }
//        }
//    }
//
//    protected function fix2WhiteSpace($str) {
//
//        return str_replace('  ', ' ', $str);
//    }

    public function region() {

        $this->autoRender = false;
        set_time_limit(0);

        $file_path = APP . 'Config' . DS . 'region_vi.json';
        App::uses('Folder', 'Utility');
        App::uses('File', 'Utility');
        $file = new File($file_path);
        if (!$file->exists()) {

            exit(__('File không tồn tại.'));
        }
        $content = $file->read();
        $arr = json_decode($content, true);
        if (empty($arr)) {

            exit(__('File không phải json.'));
        }
        foreach ($arr as $k => $v) {

            $save_data = array(
                'name' => $v['name'],
                'code' => $v['code'],
                'weight' => $k,
            );
            $this->Region->create();
            $this->Region->save($save_data);
            $parent_id = $this->Region->getLastInsertID();
            if (empty($v['district'])) {

                continue;
            }
            $district_data = array();
            foreach ($v['district'] as $kk => $vv) {

                $district_data[] = array(
                    'parent_id' => $parent_id,
                    'name' => $vv['name'],
                    'weight' => $kk,
                );
            }
            $this->Region->saveAll($district_data);
        }
    }

}
