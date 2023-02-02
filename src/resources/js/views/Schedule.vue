<template>
    <div>
        <h1>Schedules</h1>
        <br>
        <el-row>
            <el-col :span="4">
                <div>
                    <el-date-picker
                        v-model="filters.date"
                        value-format="yyyy-MM-dd"
                        type="date"
                        placeholder="Date">
                    </el-date-picker>
                </div>
            </el-col>
            <el-col :span="4">
                <el-time-picker
                    v-model="filters.time"
                    value-format="HH:mm:00"
                    format="HH:mm:00"
                    :picker-options="{
                        start: '00:00',
                        step: '00:30',
                        end: '23:59'
                      }"
                    placeholder="Time">
                </el-time-picker>
            </el-col>
            <el-col :span="4">
                <el-input placeholder="Group" v-model="filters.group"></el-input>
            </el-col>
            <el-col :span="4">
                <el-input placeholder="Room" v-model="filters.room"></el-input>
            </el-col>
            <el-col :span="4">
                <el-input placeholder="Teacher" v-model="filters.teacher"></el-input>
            </el-col>
            <el-col :span="4">
                <el-button type="warning" @click="clearFilters">Clear</el-button>
            </el-col>
        </el-row>
        <br>
        <el-table
            v-loading="loading"
            :data="tableData"
            style="width: 100%">
            <el-table-column
                label="ID"
                min-width="30px"
                prop="id">
            </el-table-column>
            <el-table-column
                label="Group"
                prop="group.name">
            </el-table-column>
            <el-table-column
                label="Teacher"
                prop="teacher.first_name">
                <template slot-scope="scope">
                    {{ scope.row.teacher.first_name + ' ' + scope.row.teacher.last_name }}
                </template>
            </el-table-column>
            <el-table-column
                label="Room"
                prop="room.name">
            </el-table-column>
            <el-table-column
                label="Subject"
                prop="subject.name">
            </el-table-column>
            <el-table-column
                label="Time">
                <template slot-scope="scope">
                    {{ scope.row.from_time + ' - ' + scope.row.to_time }}
                </template>
            </el-table-column>
            <el-table-column
                label="Start Date"
                prop="from_date">
            </el-table-column>
            <el-table-column
                label="End Date"
                prop="to_date">
            </el-table-column>
            <el-table-column
                label="Days">
                <template slot-scope="scope">
                    {{ getDows(scope.row) }}
                </template>
            </el-table-column>
            <el-table-column
                align="right">
                <template slot="header" slot-scope="scope">
                    <el-button type="primary" size="mini" @click="openAddDialog">Add Schedule</el-button>
                </template>
                <template slot-scope="scope">
                    <el-button
                        size="mini"
                        @click="openUpdateDialog(scope.$index, scope.row)">Edit
                    </el-button>
                    <el-button
                        size="mini"
                        type="danger"
                        @click="deleteSchedule(scope.$index, scope.row)">Delete
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
            title="Schedule"
            :visible.sync="dialogVisible"
            width="50%"
            :before-close="handleClose">
            <span>
                <el-row :gutter="20">
                    <el-col :span="12">
                        <el-select v-model="dialog.group_id" style="width: 100%" placeholder="Group">
                            <el-option
                                v-for="item in groups.data"
                                :key="item.id"
                                :label="item.name"
                                :value="item.id">
                        </el-option>
                      </el-select>
                    </el-col>
                    <el-col :span="12">
                        <el-select v-model="dialog.room_id" style="width: 100%" placeholder="Room">
                            <el-option
                                v-for="item in rooms.data"
                                :key="item.id"
                                :label="item.name"
                                :value="item.id">
                        </el-option>
                      </el-select>
                    </el-col>
                </el-row>
                <br>
                <el-row :gutter="20">
                    <el-col :span="12">
                        <el-select v-model="dialog.subject_id" style="width: 100%" placeholder="Subject">
                            <el-option
                                v-for="item in subjects.data"
                                :key="item.id"
                                :label="item.name"
                                :value="item.id">
                        </el-option>
                      </el-select>
                    </el-col>
                    <el-col :span="12">
                        <el-select v-model="dialog.teacher_id" style="width: 100%" placeholder="Teacher">
                            <el-option
                                v-for="item in teachers.data"
                                :key="item.id"
                                :label="item.first_name + ' ' + item.last_name"
                                :value="item.id">
                        </el-option>
                      </el-select>
                    </el-col>
                </el-row>
                <br>
                <el-row :gutter="20">
                    <el-col>
                            <el-date-picker
                                v-model="daterange"
                                value-format="yyyy-MM-dd"
                                type="daterange"
                                range-separator="To"
                                start-placeholder="Start date"
                                end-placeholder="End date">
                            </el-date-picker>
                    </el-col>
                </el-row>
                <br>
                <el-row>
                    <el-col>
                            <el-time-picker
                                is-range
                                v-model="timerange"
                                value-format="HH:mm:ss"
                                format="HH:mm:ss"
                                range-separator="To"
                                start-placeholder="Start Time"
                                end-placeholder="End Time">
                            </el-time-picker>
                    </el-col>
                </el-row>
                <br>
                <el-row>
                      <el-checkbox-group v-model="checkedDays" :min="1">
                        <el-checkbox v-for="day in days" :label="day.name" :key="day.id">{{ day.name }}</el-checkbox>
                      </el-checkbox-group>
                </el-row>
            </span>

            <span slot="footer" class="dialog-footer"><el-button type="primary" @click="addSchedule"
                                                                 v-if="isCreateAction">Save</el-button></span>
            <span slot="footer" class="dialog-footer"><el-button type="primary" @click="updateSchedule"
                                                                 v-if="!isCreateAction">Update</el-button></span>
        </el-dialog>
    </div>
</template>
<script>
export default {
    name: "schedule",
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
                group_id: null,
                teacher_id: null,
                room_id: null,
                subject_id: null,
                dows: [],
                from_date: '',
                to_date: '',
                from_time: '',
                to_time: '',
            },
            filters: {
                date: null,
                time: null,
                group: "",
                room: "",
                teacher: ""
            },
            daterange: "",
            timerange: "",
            loading: false,
            groups: null,
            subjects: null,
            rooms: null,
            teachers: null,
            checkedDays: [],
            days: [
                {
                    id: 1,
                    name: 'monday'
                }, {
                    id: 2,
                    name: 'tuesday'
                }, {
                    id: 3,
                    name: 'wednesday'
                }, {
                    id: 4,
                    name: 'thursday'
                }, {
                    id: 5,
                    name: 'friday'
                }, {
                    id: 6,
                    name: 'saturday'
                }, {
                    id: 7,
                    name: 'sunday'
                }
            ],
        }
    },
    mounted() {
        this.getSchedules();
        this.getGroups();
        this.getSubjects();
        this.getRooms();
        this.getTeachers();
    },
    computed: {},
    methods: {
        clearFilters(){
            this.filters ={
                date: null,
                time: null,
                group: "",
                room: "",
                teacher: ""
            }
        },
        getDows(row) {
            let weekdays = ''
            row.dows.forEach((dow) => {
                weekdays += dow.name + ', '
            })
            return weekdays
        },
        openAddDialog() {
            this.isCreateAction = true;
            this.dialogVisible = true;
        },
        openUpdateDialog(index, row) {

            this.isCreateAction = false;
            this.dialogVisible = true;
            this.dialog.id = row.id
            this.dialog.from_date = row.from_date
            this.dialog.to_date = row.to_date
            this.dialog.from_time = row.from_time
            this.dialog.to_time = row.to_time
            this.dialog.group_id = row.group.id
            this.dialog.room_id = row.room.id
            this.dialog.teacher_id = row.teacher.id
            this.dialog.subject_id = row.subject.id
            this.daterange = [
                this.dialog.from_date,
                this.dialog.to_date,
            ]
            this.timerange = [
                this.dialog.from_time,
                this.dialog.to_time,
            ]
            this.checkedDays = []

            row.dows.forEach((dow) => {
                this.checkedDays.push(dow.name)
            })
        },
        closeDialog() {
            this.dialogVisible = false;
            this.dialog = {
                id: null,
                group_id: null,
                teacher_id: null,
                room_id: null,
                subject_id: null,
                dows: [],
                from_date: '',
                to_date: '',
                from_time: '',
                to_time: '',
            }
        },
        handleClose(done) {
            this.dialog = {
                id: null,
                group_id: null,
                teacher_id: null,
                room_id: null,
                subject_id: null,
                dows: [],
                from_date: '',
                to_date: '',
                from_time: '',
                to_time: '',
            }
            done();
        },
        async getTeachers() {
            await axios.get('/api/teachers?all')
                .then((res) => {
                    this.teachers = res.data
                })
        },
        async getGroups() {
            await axios.get('/api/groups?all')
                .then((res) => {
                    this.groups = res.data
                })
        },
        async getSubjects() {
            await axios.get('/api/subjects?all')
                .then((res) => {
                    this.subjects = res.data
                })
        },
        async getRooms() {
            await axios.get('/api/rooms?all')
                .then((res) => {
                    this.rooms = res.data
                })
        },
        async getSchedules() {
            this.loading = true
            let currentPage = this.currentPage
            let filters = this.filters
            await axios.get('/api/schedules',{
                params: {
                    page: currentPage,
                    date: filters.date,
                    time: filters.time,
                    room: filters.room,
                    teacher: filters.teacher,
                    group: filters.group,
                }
                // params: {
                //     page: this.currentPage
                // },
                // paramsSerializer: params => {
                //     return qs.stringify(params)
                // }
            })
                .then((res) => {
                    this.tableData = res.data.data
                    this.meta = res.data.meta
                });
            this.loading = false
        },
        async deleteSchedule(index, row) {
            let room_id = row.id
            await axios.delete("/api/schedules/" + room_id)
                .then((res) => {
                    this.getSchedules()
                    this.showSuccessMessage("Schedule was deleted successfully")
                }).catch((res) => {
                    this.showErrorMessage(res.response.data.message)
                })
        },
        async addSchedule() {
            await axios.post('/api/schedules', this.dialog)
                .then((res) => {
                    this.closeDialog()
                    this.getSchedules()
                    this.showSuccessMessage("Schedule was added successfully")
                }).catch((res) => {
                    this.showErrorMessage(res.response.data.message)
                })

        },
        async updateSchedule() {
            await axios.patch('/api/schedules/' + this.dialog.id, this.dialog)
                .then((res) => {
                    this.closeDialog()
                    this.getSchedules()
                    this.showSuccessMessage("Schedule was updated successfully")
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
            this.getSchedules();
        },
        daterange(dates) {
            this.dialog.from_date = dates[0]
            this.dialog.to_date = dates[1]
        },
        timerange(times) {
            this.dialog.from_time = times[0]
            this.dialog.to_time = times[1]
        },
        checkedDays(days) {
            this.dialog.dows = []
            this.days.forEach((day) => {
                if (days.includes(day.name)) {
                    this.dialog.dows.push(day.id)
                }
            })
        },
        filters: {
            handler: function(){
                this.currentPage = 1
                this.getSchedules()
            },
            deep: true
            // this.getSchedules()
        }
    },
};
</script>
