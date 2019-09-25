<?php
namespace Db\Database;
/**
 * 
 */

interface IDatabase{
    public function connect();
    public function query($sql);
}