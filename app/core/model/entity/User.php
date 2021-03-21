<?php

namespace Etsik\Model\Entity;

use Etsik\Core\BaseEntity;

class User extends BaseEntity
{
    private $id;
    private $firstname;
    private $lastname;
    private $username;
    private $email;
    private $password;
    private $role;
    private $avatarFolder;
    private $avatarFilename;

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getManagerEntity()
    {
        return 'UserManager';
    }

    /**
    * Converts the entity in an array
    */
    public function toArray()
    {
        $objectArray = get_object_vars($this);

        $objectArray['avatar'] = $this->getAvatar();
        $objectArray['avatarResized'] = $this->getAvatarResized();
        $objectArray['avatarCropped'] = $this->getAvatarCropped();

        return $objectArray;
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLastname()
    {
        return ucfirst($this->lastname);
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getFirstname()
    {
        return ucfirst($this->firstname);
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getFullname($format = false)
    {
        ($format) ? $lastname = strtoupper("<b>".$this->getLastname()."</b>") : $lastname = $this->getLastname();
        return $this->getFirstname().' '.$lastname;
    }

    public function getFullnameReverse( $format = false)
    {
        ($format) ? $lastname = strtoupper("<b>".$this->getLastname()."</b>") : $lastname = $this->getLastname();
        return $lastname.' '.$this->getFirstname();
    }


    public function getInitials()
    {
        return strtoupper($this->getFirstname()[0].$this->getLastname()[0]);
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function addAccess($access)
    {
        $this->accesss[] = $access;
    }

    public function getAccessArray()
    {
        return $this->accesss;
    }

    public function save($nspace = null) {
        $user = parent::save('Etsik');
        return $user;
    }

    public function delete($nspace = null) {
        parent::delete('Etsik');
    }


    /**
     * Get the value of avatarFolder
     */ 
    public function getAvatarFolder()
    {
        return $this->avatarFolder;
    }

    /**
     * Set the value of avatarFolder
     *
     * @return  self
     */ 
    public function setAvatarFolder($avatarFolder)
    {
        $this->avatarFolder = $avatarFolder;

        return $this;
    }

    /**
     * Get the value of avatarFilename
     */ 
    public function getAvatarFilename()
    {
        return $this->avatarFilename;
    }

    /**
     * Set the value of avatarFilename
     *
     * @return  self
     */ 
    public function setAvatarFilename($avatarFilename)
    {
        $this->avatarFilename = $avatarFilename;

        return $this;
    }

    public function getAvatar() {
        return $this->getAvatarFolder().$this->getAvatarFilename();
    }

    public function getAvatarCropped() {
        return $this->getAvatarFolder().'cropped/cropped_'.$this->getAvatarFilename();
    }

    public function getAvatarResized() {
        return $this->getAvatarFolder().'resized/resized_'.$this->getAvatarFilename();
    }
}
