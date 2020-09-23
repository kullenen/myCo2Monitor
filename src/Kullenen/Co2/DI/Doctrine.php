<?php

namespace Kullenen\Co2\DI;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;

class Doctrine {
	public static function register($container) {
		$container->set(
			EntityManager::class,
			function ($container) {
				$metadataPath = [__DIR__ . '/../Entities'];

				$config = Setup::createAnnotationMetadataConfiguration(
					$metadataPath,
					$container->get('settings')['doctrine']['dev_mode']
				);

				$config->setMetadataDriverImpl(
					new AnnotationDriver(
						new AnnotationReader,
						$metadataPath
					)
				);

				$config->setMetadataCacheImpl(
					new FilesystemCache(
						$container->get('settings')['doctrine']['cache_dir']
					)
				);

				return EntityManager::create(
					$container->get('settings')['doctrine']['connection'],
					$config
				);
			}
		);
	}
}
