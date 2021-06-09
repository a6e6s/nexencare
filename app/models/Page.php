<?php

/*
 * Copyright (C) 2018 Easy CMS Framework Ahmed Elmahdy
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License
 * @license    https://opensource.org/licenses/GPL-3.0
 *
 * @package    Easy CMS MVC framework
 * @author     Ahmed Elmahdy
 * @link       https://ahmedx.com
 *
 * For more information about the author , see <http://www.ahmedx.com/>.
 */

class Page extends Model
{
    public function __construct()
    {
        parent::__construct('pages');
    }

    /**
     * get all pages from datatbase
     * @return object page data
     */
    public function getPages($cols = '*', $bind = '', $start = '', $count = '')
    {
        $results = $this->get($cols, $bind, $start, $count);
        return $results;
    }


    /**
     * get all pages from datatbase
     * @return object page data
     */
    public function getPagesTitle()
    {
        $results = $this->get('page_id, title, alias', ['status' => 1]);
        return $results;
    }

    public function getPageById($id)
    {
        return $this->getBy(['page_id' => $id, 'status' => 1]);
    }

    /**
     * store Member
     *
     * @param array $data
     * @return boolean
     */
    public function addMember($data)
    {
        $this->db->query('INSERT INTO Members( first_name, nationality, gender, second_name, last_name, family_name, image, status, updated_at, created_at)'
            . ' VALUES (:first_name, :nationality, :gender, :second_name, :last_name, :family_name, :image, :status, :updated_at, :created_at)');
        // binding values
        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':nationality', $data['nationality']);
        $this->db->bind(':gender', $data['gender']);
        $this->db->bind(':second_name', $data['second_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':family_name', $data['family_name']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':status', 0);
        $this->db->bind(':created_at', time());
        $this->db->bind(':updated_at', time());
        // excute
        if ($this->db->excute()) {
            return true;
        } else {
            return false;
        }
    }
}
