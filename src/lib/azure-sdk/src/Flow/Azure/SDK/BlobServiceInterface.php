<?php

declare(strict_types=1);

namespace Flow\Azure\SDK;

use Flow\Azure\SDK\BlobService\BlockBlob\BlockList;
use Flow\Azure\SDK\BlobService\CopyBlob\CopyBlobOptions;
use Flow\Azure\SDK\BlobService\CreateContainer\CreateContainerOptions;
use Flow\Azure\SDK\BlobService\DeleteBlob\DeleteBlobOptions;
use Flow\Azure\SDK\BlobService\DeleteContainer\DeleteContainerOptions;
use Flow\Azure\SDK\BlobService\GetBlob\{BlobContent, GetBlobOptions};
use Flow\Azure\SDK\BlobService\GetBlobProperties\{BlobProperties, GetBlobPropertiesOptions};
use Flow\Azure\SDK\BlobService\GetBlockBlobBlockList\GetBlockBlobBlockListOptions;
use Flow\Azure\SDK\BlobService\GetContainerProperties\{ContainerProperties, GetContainerPropertiesOptions};
use Flow\Azure\SDK\BlobService\ListBlobs\{Blob, ListBlobOptions};
use Flow\Azure\SDK\BlobService\PutBlockBlob\PutBlockBlobOptions;
use Flow\Azure\SDK\BlobService\PutBlockBlobBlock\PutBlockBlobBlockOptions;
use Flow\Azure\SDK\BlobService\PutBlockBlobBlockList\{PutBlockBlobBlockListOptions};

interface BlobServiceInterface
{
    public function copyBlob(string $fromBlob, string $toBlob, ?CopyBlobOptions $options = null) : void;

    public function deleteBlob(string $blob, ?DeleteBlobOptions $options = null) : void;

    public function deleteContainer(?DeleteContainerOptions $options = null) : void;

    public function getBlob(string $blob, ?GetBlobOptions $options = null) : BlobContent;

    public function getBlobProperties(string $blob, ?GetBlobPropertiesOptions $options = null) : ?BlobProperties;

    public function getBlockBlobBlockList(string $blob, ?GetBlockBlobBlockListOptions $options = null) : BlockList;

    public function getContainerProperties(?GetContainerPropertiesOptions $options = null) : ?ContainerProperties;

    /**
     * @return \Generator<Blob>
     */
    public function listBlobs(?ListBlobOptions $options = null) : \Generator;

    /**
     * @param null|resource|string $content
     */
    public function putBlockBlob(string $path, $content = null, ?int $size = null, ?PutBlockBlobOptions $options = null) : void;

    /**
     * @param resource|string $content
     */
    public function putBlockBlobBlock(string $path, string $blockId, $content, int $size, ?PutBlockBlobBlockOptions $options = null) : void;

    public function putBlockBlobBlockList(string $path, BlockList $blockList, ?PutBlockBlobBlockListOptions $options = null, ?Serializer $serializer = null) : void;

    public function putContainer(?CreateContainerOptions $options = null) : void;
}
