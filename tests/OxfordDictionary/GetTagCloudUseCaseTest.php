<?php

namespace App\Tests\OxfordDictionary;

use App\Service\OxfordDictionary\UseCases\GetTagCloudUseCase;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use PHPUnit\Framework\TestCase;

class GetTagCloudUseCaseTest extends TestCase
{
    const RESPONSE = array ( 0 => array ( 'id' => 11, 'word' => 'et', 'searches' => 995, ), 1 => array ( 'id' => 50, 'word' => 'vel', 'searches' => 990, ), 2 => array ( 'id' => 65, 'word' => 'repellat', 'searches' => 985, ), 3 => array ( 'id' => 79, 'word' => 'eos', 'searches' => 980, ), 4 => array ( 'id' => 73, 'word' => 'repudiandae', 'searches' => 979, ), 5 => array ( 'id' => 43, 'word' => 'adipisci', 'searches' => 978, ), 6 => array ( 'id' => 86, 'word' => 'doloremque', 'searches' => 962, ), 7 => array ( 'id' => 83, 'word' => 'optio', 'searches' => 952, ), 8 => array ( 'id' => 63, 'word' => 'autem', 'searches' => 931, ), 9 => array ( 'id' => 8, 'word' => 'et', 'searches' => 927, ), 10 => array ( 'id' => 19, 'word' => 'non', 'searches' => 894, ), 11 => array ( 'id' => 80, 'word' => 'eius', 'searches' => 882, ), 12 => array ( 'id' => 10, 'word' => 'deleniti', 'searches' => 881, ), 13 => array ( 'id' => 99, 'word' => 'sint', 'searches' => 852, ), 14 => array ( 'id' => 32, 'word' => 'hic', 'searches' => 842, ), 15 => array ( 'id' => 54, 'word' => 'dolores', 'searches' => 840, ), 16 => array ( 'id' => 41, 'word' => 'alias', 'searches' => 839, ), 17 => array ( 'id' => 90, 'word' => 'voluptas', 'searches' => 825, ), 18 => array ( 'id' => 78, 'word' => 'quia', 'searches' => 817, ), 19 => array ( 'id' => 36, 'word' => 'quasi', 'searches' => 805, ), 20 => array ( 'id' => 49, 'word' => 'eum', 'searches' => 798, ), 21 => array ( 'id' => 75, 'word' => 'quia', 'searches' => 793, ), 22 => array ( 'id' => 4, 'word' => 'veritatis', 'searches' => 787, ), 23 => array ( 'id' => 7, 'word' => 'earum', 'searches' => 785, ), 24 => array ( 'id' => 5, 'word' => 'natus', 'searches' => 780, ), 25 => array ( 'id' => 97, 'word' => 'natus', 'searches' => 778, ), 26 => array ( 'id' => 29, 'word' => 'itaque', 'searches' => 763, ), 27 => array ( 'id' => 24, 'word' => 'et', 'searches' => 752, ), 28 => array ( 'id' => 27, 'word' => 'quam', 'searches' => 721, ), 29 => array ( 'id' => 100, 'word' => 'eligendi', 'searches' => 693, ), 30 => array ( 'id' => 40, 'word' => 'eos', 'searches' => 676, ), 31 => array ( 'id' => 14, 'word' => 'porro', 'searches' => 667, ), 32 => array ( 'id' => 61, 'word' => 'reprehenderit', 'searches' => 664, ), 33 => array ( 'id' => 20, 'word' => 'cupiditate', 'searches' => 663, ), 34 => array ( 'id' => 37, 'word' => 'est', 'searches' => 655, ), 35 => array ( 'id' => 96, 'word' => 'quia', 'searches' => 652, ), 36 => array ( 'id' => 44, 'word' => 'molestias', 'searches' => 648, ), 37 => array ( 'id' => 17, 'word' => 'voluptatem', 'searches' => 645, ), 38 => array ( 'id' => 38, 'word' => 'aliquid', 'searches' => 640, ), 39 => array ( 'id' => 60, 'word' => 'quis', 'searches' => 640, ), 40 => array ( 'id' => 39, 'word' => 'itaque', 'searches' => 635, ), 41 => array ( 'id' => 67, 'word' => 'quis', 'searches' => 634, ), 42 => array ( 'id' => 30, 'word' => 'aliquam', 'searches' => 585, ), 43 => array ( 'id' => 15, 'word' => 'architecto', 'searches' => 581, ), 44 => array ( 'id' => 47, 'word' => 'nam', 'searches' => 568, ), 45 => array ( 'id' => 55, 'word' => 'sint', 'searches' => 566, ), 46 => array ( 'id' => 16, 'word' => 'at', 'searches' => 555, ), 47 => array ( 'id' => 57, 'word' => 'laborum', 'searches' => 543, ), 48 => array ( 'id' => 69, 'word' => 'inventore', 'searches' => 543, ), 49 => array ( 'id' => 95, 'word' => 'ratione', 'searches' => 543, ), );
    /**
     * @test
     */
    public function we_can_perform_a_handler()
    {
        $objectManager = $this->createMock(EntityManagerInterface::class);

        $queryBuilderMock = $this->getMockBuilder(QueryBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $entityRepositoryMock = $this->getMockBuilder(EntityRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $objectManager
            ->expects($this->once())
            ->method('getRepository')
            ->willReturn($entityRepositoryMock);

        $entityRepositoryMock
            ->expects($this->once())
            ->method('createQueryBuilder')
            ->with('s')
            ->willReturn($queryBuilderMock);

        $queryBuilderMock
            ->expects($this->at(0))
            ->method('orderBy')
            ->with('s.searches', 'DESC')
            ->willReturn($queryBuilderMock);

        $queryBuilderMock
            ->expects($this->at(1))
            ->method('setMaxResults')
            ->with(50)
            ->willReturn($queryBuilderMock);

        $queryMock = $this->getMockBuilder(AbstractQuery::class)
            ->disableOriginalConstructor()
            ->setMethods(['getArrayResult'])
            ->getMockForAbstractClass();

        $queryBuilderMock
            ->expects($this->at(2))
            ->method('getQuery')
            ->with()
            ->willReturn($queryMock);

        $queryMock
            ->expects($this->once())
            ->method('getArrayResult')
            ->with()
            ->willReturn(self::RESPONSE);

        $api = new GetTagCloudUseCase($objectManager);
        $result = $api->handler();
        $this->assertIsArray($result);
    }
}

