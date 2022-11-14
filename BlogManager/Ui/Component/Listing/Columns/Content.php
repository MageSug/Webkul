<?php
namespace Webkul\BlogManager\Ui\Component\Listing\Columns;

use Magento\Ui\Component\Listing\Columns\Column;

class Content extends Column
{
    public function prepareDataSource(array $dataSource)
    {
        if(isset($dataSource['data']['items']))
        {
            $fieldName = 'content';
            foreach($dataSource['data']['items'] as &$item)
            {
                if(isset($item[$fieldName]))
                    $item[$fieldName] = substr($item[$fieldName], 0, 20).'...';
            }
        }
        return $dataSource;
    }
}
