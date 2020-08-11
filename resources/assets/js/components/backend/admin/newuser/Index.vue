<template>
  <div class="main-content">
    <div class="content-sec">
      <div class="taxInfo">
        <div class="tex-key-table">
          <div class="title-main">
            <h2 v-text="trans('common.new_users')"></h2>
          </div>
          <div class="table-responsive" v-if="users && users.data && users.data.length">
            <table class="table custom-table table-bordered">
              <tbody>
                <tr>
                  <th width="20%" v-text="trans('common.Client')"></th>
                  <th width="20%" v-text="trans('common.Email_address')"></th>
                  <th width="20%" v-text="trans('common.City')"></th>
                  <th width="20%" v-text="trans('common.PostalCode')"></th>
                </tr>
                <tr v-for="(user, key) in users.data" :key="key">
                  <td>
                    <span v-if="user.profile" v-text="user.profile.first_name"></span>
                    <span v-if="user.profile" v-text="user.profile.last_name"></span>
                  </td>
                  <td v-text="user.email"></td>
                  <td>
                    <span v-if="user.profile" v-text="user.profile.city"></span>
                  </td>
                  <td>
                    <span v-if="user.profile" v-text="user.profile.postal_code"></span>
                  </td>
                </tr>
              </tbody>
            </table>
            </div>
            <div v-else class="empty-result"
              v-text="trans('client.NoCustomerFound')">
            </div>
          </div>
        </div>
      </div>
    </div>
</template>
<script>
import userService from '../../../../services/userService';

export default {
  data() {
    return {
      users: [],
    };
  },
  beforeCreate() {
    userService.getAll().then((resp) => {
      this.users = resp.data;
    });
  },
};
</script>
