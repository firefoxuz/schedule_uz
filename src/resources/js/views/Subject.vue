<template>
    <div>
        <h1>Subjects</h1>
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
                    <el-button type="primary" size="mini" @click="openAddDialog">Add Subject</el-button>
                </template>
                <template slot-scope="scope">
                    <el-button
                        size="mini"
                        @click="openUpdateDialog(scope.$index, scope.row)">Edit
                    </el-button>
                    <el-button
                        size="mini"
                        type="danger"
                        @click="deleteSubject(scope.$index, scope.row)">Delete
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
            title="Subject"
            :visible.sync="dialogVisible"
            width="50%"
            :before-close="handleClose">
            <span>
                <el-input placeholder="Name" v-model="dialog.name"></el-input>
            </span>
            <span slot="footer" class="dialog-footer"><el-button type="primary" @click="addSubject" v-if="isCreateAction">Save</el-button></span>
            <span slot="footer" class="dialog-footer"><el-button type="primary" @click="updateSubject"
                                                                 v-if="!isCreateAction">Update</el-button></span>
        </el-dialog>
    </div>
</template>
<script>
export default {
    name: "subject",
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
        this.getSubjects();
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
        async getSubjects() {
            this.loading = true
            await axios.get('/api/subjects?page=' + this.currentPage)
                .then((res) => {
                    this.tableData = res.data.data
                    this.meta = res.data.meta
                });
            this.loading = false
        },
        async deleteSubject(index, row) {
            let room_id = row.id
            await axios.delete("/api/subjects/" + room_id)
                .then((res) => {
                    this.getSubjects()
                    this.showSuccessMessage("Subject was deleted successfully")
                }).catch((res) => {
                    this.showErrorMessage(res.response.data.message)
                })
        },
        async addSubject() {
            await axios.post('/api/subjects', this.dialog)
                .then((res) => {
                    this.closeDialog()
                    this.getSubjects()
                    this.showSuccessMessage("Subject was added successfully")
                }).catch((res) => {
                    this.showErrorMessage(res.response.data.message)
                })

        },
        async updateSubject() {
            await axios.patch('/api/subjects/' + this.dialog.id, this.dialog)
                .then((res) => {
                    this.closeDialog()
                    this.getSubjects()
                    this.showSuccessMessage("Subject was updated successfully")
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
            this.getSubjects();
        }
    },
};
</script>
