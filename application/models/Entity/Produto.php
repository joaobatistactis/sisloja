<?php
/**
 * Copyright 2012 ICMBio
 * Este arquivo é parte do programa SISICMBio
 * O SISICMBio é um software livre; você pode redistribuí-lo e/ou modificá-lo dentro dos termos
 * da Licença Pública Geral GNU como publicada pela Fundação do Software Livre (FSF); na versão
 * 2 da Licença.
 *
 * Este programa é distribuído na esperança que possa ser útil, mas SEM NENHUMA GARANTIA; sem
 * uma garantia implícita de ADEQUAÇÃO a qualquer MERCADO ou APLICAÇÃO EM PARTICULAR. Veja a
 * Licença Pública Geral GNU/GPL em português para maiores detalhes.
 * Você deve ter recebido uma cópia da Licença Pública Geral GNU, sob o título "LICENCA.txt",
 * junto com este programa, se não, acesse o Portal do Software Público Brasileiro no endereço
 * www.softwarepublico.gov.br ou escreva para a Fundação do Software Livre(FSF)
 * Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301, USA
 * */

namespace Application\Model\Entity;

/**
 * Sarr\Model\Entity\Produto
 *
 * @Table(name="produto")
 * @Entity(repositoryClass="Application\Model\Repository\Produto")
 */
class Produto
{
    /**
     * @var integer $idProduto
     *
     * @Id
     * @Column(name="id_produto", type="integer", nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    private $idProduto;

    /**
     * @var string $noProduto
     *
     * @Column(name="no_produto", type="string")
     */
    private $noProduto;

    /**
     * @var string $nuPreco
     *
     * @Column(name="nu_preco", type="integer")
     */
    private $nuPreco;

    /**
     * Get sqAplicacaoPrazo
     *
     * @return integer
     */
    public function getIdProduto()
    {
        return $this->idProduto;
    }

    /**
     * Set noAplicacaoPrazo
     *
     * @param string $noAplicacaoPrazo
     * @return SarrAplicacaoPrazo
     */
    public function setNoProduto($noProduto)
    {
        $this->noProduto = $noProduto;
        return $this;
    }



    public function getNoProduto()
    {
        return $this->noProduto;
    }

    public function getNuPreco()
    {
        return $this->nuPreco;
    }

    public function setNuPreco($nuPreco)
    {
        $this->nuPreco = $nuPreco;
    }
}