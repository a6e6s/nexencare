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

class Member extends ModelAdmin
{

    public function __construct()
    {
        parent::__construct('members');
    }

    /**
     * get all Members from datatbase
     *
     * @param  string $cond
     * @param  array $bind
     * @param  string $limit
     * @param  mixed $bindLimit
     *
     * @return object Members data
     */
    public function getMembers($cond = '', $bind = '', $limit = '', $bindLimit)
    {
        $query = 'SELECT * FROM members ' . $cond . ' ORDER BY members.created_at DESC ';

        return $this->getAll($query, $bind, $limit, $bindLimit);
    }

    /**
     * get count of all records
     * @param type $cond
     * @return type
     */
    public function allMembersCount($cond = '', $bind = '')
    {
        return $this->countAll($cond, $bind);
    }

    /**
     * insert new Members
     * @param array $data
     * @return boolean
     */
    public function addMember($data)
    {
        $this->db->query('INSERT INTO members( image, full_name, identity, phone, nationality, gender, email, status, updated_at, created_at)'
            . ' VALUES ( :image, :full_name, :identity, :phone, :nationality, :gender, :email, :status, :updated_at, :created_at)');
        // binding values
        $this->db->bind(':identity', $data['identity']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':full_name', $data['full_name']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':nationality', $data['nationality']);
        $this->db->bind(':gender', $data['gender']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':created_at', time());
        $this->db->bind(':updated_at', time());

        // excute
        if ($this->db->excute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateMember($data)
    {
        $query = 'UPDATE members SET full_name = :full_name, identity = :identity, status = :status, phone = :phone, nationality = :nationality';
        if (!empty($data['image'])) $query .= ', image = :image';
        $query .= ', gender = :gender, email = :email, updated_at = :updated_at WHERE member_id = :member_id';
        $this->db->query($query);
        // binding values
        $this->db->bind(':member_id', $data['member_id']);
        $this->db->bind(':identity', $data['identity']);
        if (!empty($data['image'])) $this->db->bind(':image', $data['image']);
        $this->db->bind(':full_name', $data['full_name']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':nationality', $data['nationality']);
        $this->db->bind(':gender', $data['gender']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':updated_at', time());
        // excute
        if ($this->db->excute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * get member by id
     * @param integer $id
     * @return object member data
     */
    public function getMemberById($id)
    {
        return $this->getById($id, 'member_id');
    }
}
