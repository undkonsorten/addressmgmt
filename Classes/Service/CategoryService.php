<?php
namespace Undkonsorten\Addressmgmt\Service;
use TYPO3\CMS\Extbase\Persistence\Generic\QueryResult;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Extbase\Domain\Model\Category;
use TYPO3\CMS\Extbase\Domain\Repository\CategoryRepository;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2017 "Eike Starkmann <starkmann@undkonsorten.com>"
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 *
 * @package speaker
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class CategoryService {

    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    public function injectCategoryRepository(CategoryRepository $categoryRepository): void
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
  * Finds all descendants of an given category
  *
  * @param Category $parentCategory
  * @param QueryResult $query
  * @return ObjectStorage $resultStorage
  */
 public function findAllDescendants (Category $parentCategory, $sorting = null){
		if($parentCategory){
		    if(is_null($sorting)){
			 $this->categoryRepository->setDefaultOrderings(array('title'=>QueryInterface::ORDER_ASCENDING));
		    }else{
		        $this->categoryRepository->setDefaultOrderings($sorting);
		    }
			$allCategories = $this->categoryRepository->findAll();

			$storage = $this->buildStorageFormQuery($allCategories);

			$resultStorage = new ObjectStorage;
			$stack = array();
			array_push($stack, $parentCategory);
			while(count($stack)>0){
				$currentRoot = array_pop($stack);
				foreach($storage as $category){
					if($category->getParent() === $currentRoot){
						$resultStorage->attach($category);
						array_push($stack, $category);
					}
				}
			}
		}
		return $resultStorage;
	}

	public function buildCategoryTree(Category $parentCategory, $sorting = null){
	    #$result[] = array('category' => $parentCategory,'children' => array());

	    $children = $this->getChildren($parentCategory, $sorting);
	    if($children){
	        foreach($children as $child){
	            $result[] = array('category' => $child, 'children' =>  $this->buildCategoryTree ($child));
	        }
	    }
	    return $result;
	}

	protected function getChildren(Category $parent, $sorting = null){
	    if(is_null($sorting)){
	        $this->categoryRepository->setDefaultOrderings(array('title'=>QueryInterface::ORDER_ASCENDING));
	    }else{
	        $this->categoryRepository->setDefaultOrderings($sorting);
	    }
	    $this->categoryRepository->setDefaultOrderings(array('title'=>QueryInterface::ORDER_ASCENDING));
	    return $this->categoryRepository->findByParent($parent);

	}

	/**
  * Builds an object storage form query
  *
  * @param QueryResult $query
  * @return ObjectStorage
  */
 protected function buildStorageFormQuery (QueryResult $query){
		$storage = new ObjectStorage;
		foreach($query as $category){
			if($category->getParent()!=NULL) $storage->attach($category);
		}
		return $storage;
	}

}

