<?php

namespace Botble\ACL\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Botble\Catalog\Models\CatalogBranch;
use Botble\Catalog\Models\CatalogZone;

class ZoneBranchPivot extends Pivot
{
  /**
   * @return BelongsTo
   */
  public function zone()
  {
    return $this->belongsTo(CatalogZone::class);
  }

  /**
   * @return BelongsTo
   */
  public function branch()
  {
    return $this->belongsTo(CatalogBranch::class);
  }
}
