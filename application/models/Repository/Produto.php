<?php
namespace Application\Model\Repository;

use Doctrine\ORM\EntityRepository,
     Doctrine\ORM\Tools\Pagination\Paginator as Paginator;


class Produto extends EntityRepository
{
    public function listGrid($params)
    {
        $queryBuilder = $this->getEntityManager()
                             ->createQueryBuilder()
                             ->select('p.nuPreco,p.noProduto')
                             ->from('app:Produto', 'p');
//                              ->where('p.noProduto = :noProduto')
//                              ->andWhere('p.nuPreco = :nuPreco')
//                              ->setParameter('noProduto', $params['noProduto'])
//                              ->setParameter('nuPreco', $params['nuPreco']);
        $queryBuilder->setFirstResult($params['iDisplayStart'])
                     ->setMaxResults($params['iDisplayLength']);

        if (isset($params['order'])) {
            foreach ($params['order'] as $order) {
                $queryBuilder->addOrderBy($order['sort'], $order['order']);
            }
        }

        $query = $queryBuilder->getQuery()->setHydrationMode(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);

        $paginator = new Paginator($query);
        $result['data'] = $paginator->getIterator();
        $result['total'] = $paginator->count();
        $result['sEcho'] = $params['sEcho'];

        return $result;
    }
}