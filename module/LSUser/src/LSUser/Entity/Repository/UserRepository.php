<?php

namespace LSUser\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository
{
    /**
     * findByLoginAndPassword
     *
     * Retorna o registro do usuário
     *
     * @param  string $login
     * @param  string $password
     * @return array
     */
    public function findByLoginAndPassword($login, $password) {

        $user = $this->findBy(array('login' => $login));

        if ($user) {
            $hashSenha = $user[0]->encryptPassword($password);

            if ($hashSenha == $user[0]->getPassword()) {
                return $user;
            }
            else
                return false;
        }
        else
            return false;
    }

    /**
     * findTypeUser
     *
     * Retorna o tipo de usuário
     *
     * @param  integer $id
     * @return array
     */
    public function findTypeUser($id)
    {
        $query = "SELECT tu.description FROM LSUser\\Entity\\User u JOIN u.typeUse tu WHERE u.active = true AND tu.active = true AND u.id = {$id}";

        return $this->_em->createQuery($query)->getResult();
    }

}
