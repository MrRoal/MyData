<ul class="nav nav-list bs-docs-sidenav nav-collapse collapse top-buffer2">
    <li {if $data.name eq 'update'} class="active" {/if}>
        <a href="{$data.admin_url}driver/update/{$data.iDriverId}">
        <i class="icon-chevron-right"></i>Driver</a>
    </li>
    <!-- <li {if $data.name eq 'bank_info'} class="active" {/if}>
        <a href="{$data.admin_url}driver/bank_info/{$data.iDriverId}"><i class="icon-chevron-right"></i>Bank Detail</a>
    </li> -->
    <li {if $data.name eq 'licence_info'} class="active" {/if}>
        <a href="{$data.admin_url}driver/licence_info/{$data.iDriverId}"><i class="icon-chevron-right"></i>License Information</a>
    </li>
    <!-- <li {if $data.name eq 'bank_info'} class="active" {/if}>
        <a href="{$data.admin_url}driver/bank_info/{$data.iDriverId}"><i class="icon-chevron-right"></i>Withdrawal Process</a>
    </li> -->
    <li {if $data.name eq 'vehicle'} class="active" {/if}>
        <a href="{$data.admin_url}driver_vehicle/vehiclelist/{$data.iDriverId}"><i class="icon-chevron-right"></i>Vehicle Information</a>
    </li>
    <li {if $data.name eq 'trip_detail'} class="active" {/if}>
        <a href="{$data.admin_url}driver/tripdetails/{$data.iDriverId}"><i class="icon-chevron-right"></i>Trip Details</a>
    </li>
</ul>