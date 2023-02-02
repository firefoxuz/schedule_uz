<template>
    <div>
        <h1>Teachers</h1>
        <el-table
            v-loading="loading"
            :data="tableData.filter(data => !search || data.name.toLowerCase().includes(search.toLowerCase()))"
            style="width: 100%">
            <el-table-column
                label="ID"
                prop="id">
            </el-table-column>
            <el-table-column
                label="First Name"
                prop="first_name">
            </el-table-column>
            <el-table-column
                label="Last Name"
                prop="last_name">
            </el-table-column>
            <el-table-column
                label="Birth Date"
                prop="birth_date">
            </el-table-column>
            <el-table-column
                label="Phone"
                prop="phone">
            </el-table-column>
            <el-table-column
                align="right">
                <template slot="header" slot-scope="scope">
                    <el-button type="primary" size="mini" @click="openAddDialog">Add Teacher</el-button>
                </template>
                <template slot-scope="scope">
                    <el-button
                        size="mini"
                        @click="openUpdateDialog(scope.$index, scope.row)">Edit
                    </el-button>
                    <el-button
                        size="mini"
                        type="danger"
                        @click="deleteTeacher(scope.$index, scope.row)">Delete
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
            title="Teacher"
            :visible.sync="dialogVisible"
            width="50%"
            :before-close="handleClose">
            <span>
                <el-row :gutter="20">
                    <el-col :span="12"><el-input placeholder="First Name"
                                                 v-model="dialog.first_name"></el-input></el-col>
                    <el-col :span="12"><el-input placeholder="Last Name" v-model="dialog.last_name"></el-input></el-col>
                </el-row>
                <br>
                <el-row :gutter="20">
                    <el-col :span="12">
                            <el-date-picker
                                style="width: 100%"
                                v-model="dialog.birth_date"
                                type="date"
                                format="yyyy-MM-dd"
                                value-format="yyyy-MM-dd"
                                placeholder="Birth Date">
                            </el-date-picker>
                    </el-col>
                    <el-col :span="12"><el-input placeholder="Phone" v-model="dialog.phone"></el-input></el-col>
                </el-row>
            </span>

            <span slot="footer" class="dialog-footer"><el-button type="primary" @click="addTeacher"
                                                                 v-if="isCreateAction">Save</el-button></span>
            <span slot="footer" class="dialog-footer"><el-button type="primary" @click="updateTeacher"
                                                                 v-if="!isCreateAction">Update</el-button></span>
        </el-dialog>
    </div>
</template>
<script>
export default {
    name: "teacher",
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
                first_name: "",
                last_name: "",
                birth_date: "",
                phone: "",
            },
            loading: false
        }
    },
    mounted() {
        this.getTeachers();
    },
    methods: {
        openAddDialog() {
            this.isCreateAction = true;
            this.dialogVisible = true;
        },
        openUpdateDialog(index, row) {
            this.isCreateAction = false;
            this.dialogVisible = true;
            this.dialog = row
        },
        closeDialog() {
            this.dialogVisible = false;
            this.dialog = {
                id: null,
                first_name: "",
                last_name: "",
                birth_date: "",
                phone: "",
            }
        },
        handleClose(done) {
            this.dialog = {
                id: null,
                first_name: "",
                last_name: "",
                birth_date: "",
                phone: "",
            }
            done();
        },
        async getTeachers() {
            this.loading = true
            await axios.get('/api/teachers?page=' + this.currentPage)
                .then((res) => {
                    this.tableData = res.data.data
                    this.meta = res.data.meta
                });
            this.loading = false
        },
        async deleteTeacher(index, row) {
            let room_id = row.id
            await axios.delete("/api/teachers/" + room_id)
                .then((res) => {
                    this.getTeachers()
                    this.showSuccessMessage("Teacher was deleted successfully")
                }).catch((res) => {
                    this.showErrorMessage(res.response.data.message)
                })
        },
        async addTeacher() {
            await axios.post('/api/teachers', this.dialog)
                .then((res) => {
                    this.closeDialog()
                    this.getTeachers()
                    this.showSuccessMessage("Teacher was added successfully")
                }).catch((res) => {
                    this.showErrorMessage(res.response.data.message)
                })

        },
        async updateTeacher() {
            await axios.patch('/api/teachers/' + this.dialog.id, this.dialog)
                .then((res) => {
                    this.closeDialog()
                    this.getTeachers()
                    this.showSuccessMessage("Teacher was updated successfully")
                }).catch((res) => {
                    this.showErrorMessage(res.response.data.message)
                });
        },
        showErrorMessage(msg) {
            this.$message.error(msg);
        },
        showSuccessMessage(msg) {
            this.$message.success(msg)
        }
    },
    watch: {
        currentPage(newPage, oldPage) {
            this.getTeachers();
        }
    },
};
</script>
