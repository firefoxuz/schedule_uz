<template>
    <div>
        <h1>Groups</h1>
        <el-table
            v-loading="loading"
            :data="tableData.filter(data => !search || data.name.toLowerCase().includes(search.toLowerCase()))"
            style="width: 100%">
            <el-table-column
                label="ID"
                prop="id">
            </el-table-column>
            <el-table-column
                label="Name"
                prop="name">
            </el-table-column>
            <el-table-column
                align="right">
                <template slot="header" slot-scope="scope">
                    <el-button type="primary" size="mini" @click="openAddDialog">Add Group</el-button>
                </template>
                <template slot-scope="scope">
                    <el-button
                        size="mini"
                        @click="openUpdateDialog(scope.$index, scope.row)">Edit
                    </el-button>
                    <el-button
                        size="mini"
                        type="danger"
                        @click="deleteGroup(scope.$index, scope.row)">Delete
                    </el-button>
                </template>
            </el-table-column>
        </el-table>
        <el-pagination
            background
            layout="prev, pager, next"
            :page-size="meta.per_page"
            :current-page.sync="currentPage"
            :total="meta.total">
        </el-pagination>

        <el-dialog
            title="Group"
            :visible.sync="dialogVisible"
            width="50%"
            :before-close="handleClose">
            <span>
                <el-input placeholder="Name" v-model="dialog.name"></el-input>
            </span>
            <span slot="footer" class="dialog-footer"><el-button type="primary" @click="addGroup" v-if="isCreateAction">Save</el-button></span>
            <span slot="footer" class="dialog-footer"><el-button type="primary" @click="updateGroup"
                                                                 v-if="!isCreateAction">Update</el-button></span>
        </el-dialog>
    </div>
</template>
<script>
export default {
    name: "Group",
    data() {
        return {
            currentPage: 1,
            dialogVisible: false,
            tableData: [],
            meta: [],
            search: '',
            isCreateAction: true,
            dialog: {
                id: null,
                name: ""
            },
            loading: false
        }
    },
    mounted() {
        this.getGroups();
    },
    methods: {
        openAddDialog() {
            this.isCreateAction = true;
            this.dialogVisible = true;
        },
        openUpdateDialog(index, row){
            this.isCreateAction = false;
            this.dialogVisible = true;
            this.dialog = row
        },
        closeDialog() {
            this.dialogVisible = false;
            this.dialog = {
                id: null,
                name: ""
            }
        },
        handleClose(done) {
            this.dialog = {
                id: null,
                name: ""
            }
            done();
        },
        async getGroups() {
            this.loading = true
            await axios.get('/api/groups?page=' + this.currentPage)
                .then((res) => {
                    this.tableData = res.data.data
                    this.meta = res.data.meta
                });
            this.loading = false
        },
        async deleteGroup(index, row) {
            let room_id = row.id
            await axios.delete("/api/groups/" + room_id)
                .then((res) => {
                    this.getGroups()
                    this.showSuccessMessage("Group was deleted successfully")
                }).catch((res) => {
                    this.showErrorMessage(res.response.data.message)
                })
        },
        async addGroup() {
            await axios.post('/api/groups', this.dialog)
                .then((res) => {
                    this.closeDialog()
                    this.getGroups()
                    this.showSuccessMessage("Group was added successfully")
                }).catch((res) => {
                    this.showErrorMessage(res.response.data.message)
                })

        },
        async updateGroup() {
            await axios.patch('/api/groups/' + this.dialog.id, this.dialog)
                .then((res) => {
                    this.closeDialog()
                    this.getGroups()
                    this.showSuccessMessage("Group was updated successfully")
                }).catch((res) => {
                    this.showErrorMessage(res.response.data.message)
                });
        },
        showErrorMessage(msg){
            this.$message.error(msg);
        },
        showSuccessMessage(msg){
            this.$message.success(msg)
        }
    },
    watch: {
        currentPage(newPage, oldPage) {
            this.getGroups();
        }
    },
};
</script>
